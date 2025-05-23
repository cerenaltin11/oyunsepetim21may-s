<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('profile');
    }
    
    /**
     * Show a user's profile
     */
    public function show($userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        $isFriend = false;
        $isPendingRequest = false;
        $isReceivedRequest = false;
        $isCurrentUser = false;
        
        if (Auth::check()) {
            $currentUser = Auth::user();
            $isCurrentUser = $currentUser->id == $userId;
            
            // Check if they are friends
            $isFriend = $currentUser->friends()
                ->where('friend_id', $userId)
                ->exists();
            
            // Check pending sent requests
            $isPendingRequest = $currentUser->pendingSentFriendRequests()
                ->where('friend_id', $userId)
                ->exists();
            
            // Check pending received requests
            $isReceivedRequest = $currentUser->pendingReceivedFriendRequests()
                ->where('user_id', $userId)
                ->exists();
        }
        
        // Get user games
        $userGames = $user->games()
            ->orderBy('user_games.created_at', 'desc')
            ->take(4)
            ->get();
            
        // Get user badges 
        $userBadges = $user->badges;
        
        return view('user-profile', [
            'user' => $user,
            'isFriend' => $isFriend,
            'isPendingRequest' => $isPendingRequest,
            'isReceivedRequest' => $isReceivedRequest,
            'isCurrentUser' => $isCurrentUser,
            'userGames' => $userGames,
            'userBadges' => $userBadges,
        ]);
    }
    
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        
        return redirect('/dashboard')->with('success', 'Profil bilgileriniz başarıyla güncellendi.');
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('Mevcut şifreniz doğru değil.');
                }
            }],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        
        return redirect('/dashboard')->with('success', 'Şifreniz başarıyla güncellendi.');
    }
    
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'banner' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096']
        ]);
        
        $user = Auth::user();
        $updated = false;
        
        // Ensure banner column exists
        try {
            if (!Schema::hasColumn('users', 'banner')) {
                DB::statement('ALTER TABLE users ADD COLUMN banner VARCHAR(255) NULL AFTER photo');
            }
        } catch (\Exception $e) {
            // If we can't add the column, continue anyway but log the error
            Log::error("Failed to add banner column: " . $e->getMessage());
        }
        
        // Profil fotoğrafını işle
        if ($request->hasFile('photo')) {
            // Eğer eski bir fotoğraf varsa sil
            if ($user->photo) {
                if (file_exists(public_path('images/profiles/' . $user->photo))) {
                    unlink(public_path('images/profiles/' . $user->photo));
                }
            }
            
            // Yeni fotoğrafı yükle
            $photoName = time() . '_' . $user->id . '.' . $request->photo->extension();
            $request->photo->move(public_path('images/profiles'), $photoName);
            
            // Kullanıcı bilgilerini güncelle
            $user->photo = $photoName;
            $updated = true;
        }
        
        // Banner fotoğrafını işle
        if ($request->hasFile('banner')) {
            // Eğer eski bir banner varsa sil
            if ($user->banner) {
                if (file_exists(public_path('images/banners/' . $user->banner))) {
                    unlink(public_path('images/banners/' . $user->banner));
                }
            }
            
            // Banner için klasör oluştur
            if (!file_exists(public_path('images/banners'))) {
                mkdir(public_path('images/banners'), 0777, true);
            }
            
            // Yeni banner'ı yükle
            $bannerName = time() . '_banner_' . $user->id . '.' . $request->banner->extension();
            $request->banner->move(public_path('images/banners'), $bannerName);
            
            // Kullanıcı bilgilerini güncelle
            $user->banner = $bannerName;
            $updated = true;
        }
        
        if ($updated) {
            $user->save();
            return redirect('/dashboard')->with('success', 'Profil fotoğraflarınız başarıyla güncellendi.');
        }
        
        return redirect('/dashboard')->with('info', 'Değişiklik yapılmadı. Lütfen bir fotoğraf seçin.');
    }
    
    public function deletePhoto()
    {
        $user = Auth::user();
        
        if ($user->photo) {
            if (file_exists(public_path('images/profiles/' . $user->photo))) {
                unlink(public_path('images/profiles/' . $user->photo));
            }
            $user->photo = null;
            $user->save();
        }
        
        return redirect('/dashboard')->with('success', 'Profil fotoğrafınız kaldırıldı.');
    }
    
    public function deleteBanner()
    {
        $user = Auth::user();
        
        if ($user->banner) {
            if (file_exists(public_path('images/banners/' . $user->banner))) {
                unlink(public_path('images/banners/' . $user->banner));
            }
            $user->banner = null;
            $user->save();
        }
        
        return redirect('/dashboard')->with('success', 'Profil banner kaldırıldı.');
    }
} 