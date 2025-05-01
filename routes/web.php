<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\DealsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Ana sayfa
Route::get('/', function () {
    return view('home');
});

// Oyunlar sayfası
Route::get('/games', [GameController::class, 'index']);

// Fallback search path directly in web routes
Route::get('/search/games', [GameController::class, 'search']);

// Oyun detay sayfaları
Route::get('/games/{slug}', [GameController::class, 'show']);

// Kategoriler sayfası
Route::get('/categories', function () {
    return view('games.index'); // Şimdilik oyunlar listesi sayfasına yönlendir
});

// Fırsatlar sayfası
Route::get('/deals', [\App\Http\Controllers\DealsController::class, 'index']);

// Sepet işlemleri
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('/cart/remove/{gameId}', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [\App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');

// İstek Listesi işlemleri
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::get('/wishlist/remove/{gameId}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/wishlist/clear', [WishlistController::class, 'clear'])->name('wishlist.clear');
Route::get('/wishlist/move-to-cart/{gameId}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');

// Ödeme işlemleri
Route::get('/checkout', [\App\Http\Controllers\PaymentController::class, 'checkout'])->name('payment.checkout');
Route::post('/payment/process', [\App\Http\Controllers\PaymentController::class, 'process'])->name('payment.process');
Route::get('/payment/success/{orderId}', [\App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');

// Giriş ve kayıt rotaları
Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', function () {
    // Validate login credentials
    $credentials = request()->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    
    // Attempt to log the user in
    if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
        request()->session()->regenerate();
        
        // Redirect to dashboard if login successful
        return redirect()->intended('/dashboard');
    }
    
    // If login fails, redirect back with error
    return back()->withErrors([
        'email' => 'E-posta veya şifre hatalı.',
    ]);
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/register', function () {
    // Validate the request data
    $data = request()->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);
    
    // Create the user
    $user = \App\Models\User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => \Illuminate\Support\Facades\Hash::make($data['password']),
    ]);
    
    // Log the user in
    \Illuminate\Support\Facades\Auth::login($user);
    
    // Regenerate the session
    request()->session()->regenerate();
    
    // Redirect to dashboard after successful registration
    return redirect('/dashboard');
});

// Kullanıcı paneli - Yalnızca giriş yapmış kullanıcılar için
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Profil sayfası ve işlemleri
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('password.update');
    
    // Profil fotoğrafı işlemleri
    Route::post('/profile/photo', [\App\Http\Controllers\ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::get('/profile/photo/delete', [\App\Http\Controllers\ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
    
    Route::get('/orders', function () {
        return view('orders');
    })->name('orders');
    
    // Çıkış yap
    Route::post('/logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
        
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        
        return redirect('/');
    })->name('logout');
});

// Debugger route to check auth status
Route::get('/auth-check', function () {
    if (auth()->check()) {
        return response()->json([
            'authenticated' => true,
            'user' => auth()->user(),
        ]);
    } else {
        return response()->json([
            'authenticated' => false,
        ]);
    }
});

// Library routes
Route::get('/library', [\App\Http\Controllers\LibraryController::class, 'index'])->name('library');
Route::get('/library/download/{gameId}', [\App\Http\Controllers\LibraryController::class, 'download'])->name('library.download');

// Review routes
Route::post('/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
Route::put('/reviews/{id}', [\App\Http\Controllers\ReviewController::class, 'update'])->name('reviews.update');
Route::delete('/reviews/{id}', [\App\Http\Controllers\ReviewController::class, 'destroy'])->name('reviews.destroy');
Route::post('/reviews/{id}/helpful', [\App\Http\Controllers\ReviewController::class, 'markHelpful'])->name('reviews.helpful');

// Admin routes - only accessible to admin users
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{id}/toggle-admin', [\App\Http\Controllers\AdminController::class, 'toggleAdmin'])->name('admin.users.toggle-admin');
    Route::get('/users/{id}/activity', [\App\Http\Controllers\AdminController::class, 'userActivity'])->name('admin.users.activity');
});

// Debug route - only for development
Route::get('/debug/session', function() {
    return response()->json([
        'cart' => session('cart'),
        'wishlist' => session('wishlist'),
        'library' => session('library'),
        'orders' => session('orders'),
        'last_order' => session('last_order')
    ]);
});
