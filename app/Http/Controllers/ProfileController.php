<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
        
        return redirect('/profile')->with('success', 'Profil bilgileriniz başarıyla güncellendi.');
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
        
        return redirect('/profile')->with('success', 'Şifreniz başarıyla değiştirildi.');
    }
    
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);
        
        $user = Auth::user();
        
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
        $user->save();
        
        return redirect('/profile')->with('success', 'Profil fotoğrafınız başarıyla güncellendi.');
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
        
        return redirect('/profile')->with('success', 'Profil fotoğrafınız kaldırıldı.');
    }
} 