<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $friends = $user->friends;
        $pendingRequests = $user->pendingReceivedFriendRequests;
        $sentRequests = $user->pendingSentFriendRequests;
        
        return view('friends', compact('friends', 'pendingRequests', 'sentRequests'));
    }
    
    public function sendRequest(Request $request, $userId)
    {
        \Log::info('Friend request started', [
            'from_user_id' => Auth::id(),
            'to_user_id' => $userId,
            'is_authenticated' => Auth::check()
        ]);
        
        if (!Auth::check()) {
            \Log::error('Friend request failed: user not authenticated');
            return response()->json([
                'status' => 'error',
                'message' => 'Kullanıcı girişi gerekli'
            ]);
        }
        
        $user = Auth::user();
        $friend = User::findOrFail($userId);
        
        \Log::info('Friend request - Users found', [
            'current_user' => $user->name,
            'target_user' => $friend->name
        ]);
        
        // Check if already friends or request exists
        if ($user->friends()->where('friend_id', $userId)->exists() ||
            $user->pendingSentFriendRequests()->where('friend_id', $userId)->exists() ||
            $user->pendingReceivedFriendRequests()->where('user_id', $userId)->exists()) {
            
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Arkadaşlık isteği zaten mevcut veya arkadaşsınız.'
                ]);
            }
            
            return back()->with('error', 'Arkadaşlık isteği zaten mevcut veya arkadaşsınız.');
        }
        
        $user->pendingSentFriendRequests()->attach($userId, ['status' => 'pending']);
        
        \Log::info('Friend request sent successfully', [
            'from_user' => $user->name,
            'to_user' => $friend->name,
            'request_id' => $userId
        ]);
        
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Arkadaşlık isteği gönderildi.'
            ]);
        }
        
        return back()->with('success', 'Arkadaşlık isteği gönderildi.');
    }
    
    public function acceptRequest($userId)
    {
        $user = Auth::user();
        $otherUser = User::findOrFail($userId);
        
        // Begin transaction to ensure both operations succeed or fail together
        DB::beginTransaction();
        
        try {
            // 1. Update the existing request to accepted
        $user->pendingReceivedFriendRequests()
            ->where('user_id', $userId)
            ->updateExistingPivot($userId, ['status' => 'accepted']);
        
            // 2. Create a reciprocal friend relationship in the other direction
            // First check if it already exists to avoid constraint violations
            $existingRelation = DB::table('friends')
                ->where('user_id', $user->id)
                ->where('friend_id', $userId)
                ->first();
                
            if ($existingRelation) {
                // Update existing relationship if it exists
                DB::table('friends')
                    ->where('user_id', $user->id)
                    ->where('friend_id', $userId)
                    ->update(['status' => 'accepted']);
            } else {
                // Create new relationship if it doesn't exist
                DB::table('friends')->insert([
                    'user_id' => $user->id,
                    'friend_id' => $userId,
                    'status' => 'accepted',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            
            DB::commit();
        return back()->with('success', 'Arkadaşlık isteği kabul edildi.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Arkadaşlık isteği kabul edilirken bir hata oluştu: ' . $e->getMessage());
        }
    }
    
    public function rejectRequest($userId)
    {
        $user = Auth::user();
        
        // Remove the friend request
        $user->pendingReceivedFriendRequests()->detach($userId);
        
        return back()->with('success', 'Arkadaşlık isteği reddedildi.');
    }
    
    public function removeFriend($userId)
    {
        $user = Auth::user();
        
        // Begin transaction
        DB::beginTransaction();
        
        try {
            // Remove from both directions in the friends table
            DB::table('friends')
                ->where(function($query) use ($user, $userId) {
                    $query->where('user_id', $user->id)
                          ->where('friend_id', $userId);
                })
                ->orWhere(function($query) use ($user, $userId) {
                    $query->where('user_id', $userId)
                          ->where('friend_id', $user->id);
                })
                ->delete();
                
            DB::commit();
        return back()->with('success', 'Arkadaş listenizden çıkarıldı.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Arkadaş çıkarılırken bir hata oluştu: ' . $e->getMessage());
        }
    }
    
    public function blockUser($userId)
    {
        $user = Auth::user();
        $friend = User::findOrFail($userId);
        
        // Remove from friends if exists
        $user->friends()->detach($userId);
        
        // Add to blocked users
        $user->blockedUsers()->attach($userId, ['status' => 'blocked']);
        
        return back()->with('success', 'Kullanıcı engellendi.');
    }
    
    public function unblockUser($userId)
    {
        $user = Auth::user();
        
        // Remove from blocked users
        $user->blockedUsers()->detach($userId);
        
        return back()->with('success', 'Kullanıcının engeli kaldırıldı.');
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        \Log::info('Friends search called', [
            'query' => $query,
            'user_id' => Auth::id(),
            'is_authenticated' => Auth::check()
        ]);
        
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kullanıcı girişi gerekli',
                'query' => $query,
                'users' => []
            ]);
        }
        
        // Ensure we have a valid query
        if (empty($query) || strlen($query) < 2) {
            return response()->json([
                'status' => 'error',
                'message' => 'Arama sorgusu çok kısa',
                'query' => $query,
                'users' => []
            ]);
        }
        
        $user = Auth::user();
        
        // Get IDs of friends, sent requests, received requests, and blocked users to exclude from search
        $friendIds = $user->friends()->pluck('friend_id')->toArray();
        $sentRequestIds = $user->pendingSentFriendRequests()->pluck('friend_id')->toArray();
        $receivedRequestIds = $user->pendingReceivedFriendRequests()->pluck('user_id')->toArray();
        $blockedUserIds = $user->blockedUsers()->pluck('friend_id')->toArray();
        
        // Combine all IDs to exclude from search
        $excludeIds = array_merge([$user->id], $friendIds, $sentRequestIds, $receivedRequestIds, $blockedUserIds);
        
        // Find all matching users first
        $allMatchingUsers = User::where('name', 'LIKE', "%{$query}%")
            ->take(10)
            ->get(['id', 'name', 'photo', 'xp']);
            
        // Classify users by exclusion reason
        $matchingUsers = [];
        $excludedInfo = [];
        
        foreach ($allMatchingUsers as $matchingUser) {
            if ($matchingUser->id === $user->id) {
                $excludedInfo[] = [
                    'user' => $matchingUser,
                    'reason' => 'self',
                    'message' => 'Bu sizin hesabınız'
                ];
            } else if (in_array($matchingUser->id, $friendIds)) {
                $excludedInfo[] = [
                    'user' => $matchingUser,
                    'reason' => 'friend',
                    'message' => 'Zaten arkadaşsınız'
                ];
            } else if (in_array($matchingUser->id, $sentRequestIds)) {
                $excludedInfo[] = [
                    'user' => $matchingUser,
                    'reason' => 'sent_request',
                    'message' => 'Arkadaşlık isteği gönderildi'
                ];
            } else if (in_array($matchingUser->id, $receivedRequestIds)) {
                $excludedInfo[] = [
                    'user' => $matchingUser,
                    'reason' => 'received_request',
                    'message' => 'Size arkadaşlık isteği gönderdi'
                ];
            } else if (in_array($matchingUser->id, $blockedUserIds)) {
                $excludedInfo[] = [
                    'user' => $matchingUser,
                    'reason' => 'blocked',
                    'message' => 'Bu kullanıcıyı engellediniz'
                ];
            } else {
                $matchingUsers[] = $matchingUser;
            }
        }
        
        // Return results with useful information about excluded users
        return response()->json([
            'status' => 'success',
            'query' => $query,
            'count' => count($matchingUsers),
            'users' => $matchingUsers,
            'excluded_info' => $excludedInfo,
            'debug' => [
                'current_user_id' => $user->id,
                'found_total' => $allMatchingUsers->count(),
                'excluded_count' => count($excludedInfo),
                'friend_ids' => $friendIds,
                'sent_request_ids' => $sentRequestIds,
                'received_request_ids' => $receivedRequestIds,
                'blocked_user_ids' => $blockedUserIds
            ]
        ]);
    }
}
