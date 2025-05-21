<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    
    public function sendRequest($userId)
    {
        $user = Auth::user();
        $friend = User::findOrFail($userId);
        
        // Check if already friends or request exists
        if ($user->friends()->where('friend_id', $userId)->exists() ||
            $user->pendingSentFriendRequests()->where('friend_id', $userId)->exists() ||
            $user->pendingReceivedFriendRequests()->where('user_id', $userId)->exists()) {
            return back()->with('error', 'Arkadaşlık isteği zaten mevcut veya arkadaşsınız.');
        }
        
        $user->pendingSentFriendRequests()->attach($userId, ['status' => 'pending']);
        
        return back()->with('success', 'Arkadaşlık isteği gönderildi.');
    }
    
    public function acceptRequest($userId)
    {
        $user = Auth::user();
        
        // Update the request status to accepted
        $user->pendingReceivedFriendRequests()
            ->where('user_id', $userId)
            ->updateExistingPivot($userId, ['status' => 'accepted']);
        
        return back()->with('success', 'Arkadaşlık isteği kabul edildi.');
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
        
        // Remove from both users' friend lists
        $user->friends()->detach($userId);
        
        return back()->with('success', 'Arkadaş listenizden çıkarıldı.');
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
        $user = Auth::user();
        
        $users = User::where('name', 'LIKE', "%{$query}%")
            ->where('id', '!=', $user->id)
            ->whereNotIn('id', $user->blockedUsers()->pluck('friend_id'))
            ->whereNotIn('id', $user->friends()->pluck('friend_id'))
            ->take(10)
            ->get();
            
        return response()->json($users);
    }
}
