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
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
Route::get('/', function() {
    // Temporarily use only the static template
    return view('temp-home');
})->name('home');

// Database check route
Route::get('/check-games', function() {
    $games = \App\Models\Game::all();
    return [
        'count' => $games->count(),
        'first_few' => $games->take(3)->map(function($game) {
            return [
                'id' => $game->id,
                'title' => $game->title,
                'category' => $game->category
            ];
        })
    ];
});

// Emergency seeder route
Route::get('/run-emergency-seeder', function() {
    $seeder = new \Database\Seeders\EmergencyGameSeeder();
    $seeder->run();
    return redirect('/check-games');
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

// Add a simple direct library route for troubleshooting
Route::get('/library-test', function () {
    $libraryItems = [];
    return view('library', [
        'libraryItems' => $libraryItems,
        'totalCount' => 0
    ]);
})->name('library.test');

// Replace the library route with a direct route definition
Route::get('/library', function() {
    // If not logged in, redirect to login
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Kütüphanenize erişmek için giriş yapmalısınız.');
    }
    
    // Get library games from session
    $libraryGames = session('library', []);
    $libraryItems = [];
    
    // Find game details for each ID
    if (!empty($libraryGames)) {
        foreach ($libraryGames as $gameId) {
            $game = \App\Models\Game::find($gameId);
            if ($game) {
                $libraryItems[] = $game;
            }
        }
    }
    
    return view('library', [
        'libraryItems' => $libraryItems,
        'totalCount' => count($libraryItems)
    ]);
})->name('library');

// Sepet işlemleri - Sadece giriş yapmış kullanıcılar için
Route::middleware(['auth'])->group(function() {
    // Sepet
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
    
    // Library download route
    Route::get('/library/download/{gameId}', [\App\Http\Controllers\LibraryController::class, 'download'])->name('library.download');
});

// Giriş ve kayıt rotaları
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // Validate login credentials
    $credentials = request()->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    
    // Attempt to log the user in
    if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
        request()->session()->regenerate();
        
        // Redirect to home page if login successful
        return redirect('/');
    }
    
    // If login fails, redirect back with error
    return back()->withErrors([
        'email' => 'E-posta veya şifre hatalı.',
    ]);
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

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
    
    // Redirect to home page after successful registration
    return redirect('/');
});

// Kullanıcı paneli - Yalnızca giriş yapmış kullanıcılar için
Route::middleware(['auth'])->group(function () {
    // Dashboard artık profil bilgilerini gösterecek
    Route::get('/dashboard', [\App\Http\Controllers\ProfileController::class, 'index'])->name('dashboard');
    
    // Profil sayfası dashboard'a yönlendirilecek
    Route::get('/profile', function () {
        return redirect('/dashboard');
    })->name('profile');
    
    Route::post('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('password.update');
    
    // Profil fotoğrafı işlemleri
    Route::post('/profile/photo', [\App\Http\Controllers\ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::get('/profile/photo/delete', [\App\Http\Controllers\ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
    Route::get('/profile/banner/delete', [\App\Http\Controllers\ProfileController::class, 'deleteBanner'])->name('profile.banner.delete');
    
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

// Review routes
Route::post('/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
Route::put('/reviews/{id}', [\App\Http\Controllers\ReviewController::class, 'update'])->name('reviews.update')->middleware('auth');
Route::delete('/reviews/{id}', [\App\Http\Controllers\ReviewController::class, 'destroy'])->name('reviews.destroy')->middleware('auth');
Route::post('/reviews/{id}/helpful', [\App\Http\Controllers\ReviewController::class, 'markHelpful'])->name('reviews.helpful')->middleware('auth');

// Admin routes - only accessible to admin users
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    
    // New Admin Panel Routes
    Route::get('/panel', [\App\Http\Controllers\AdminController::class, 'panel'])->name('admin.panel');
    
    // User Management
    Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{id}/toggle-admin', [\App\Http\Controllers\AdminController::class, 'toggleAdmin'])->name('admin.users.toggle-admin');
    Route::get('/users/{id}/activity', [\App\Http\Controllers\AdminController::class, 'userActivity'])->name('admin.users.activity');
    
    // Game Management
    Route::get('/games', [\App\Http\Controllers\AdminController::class, 'games'])->name('admin.games');
    Route::get('/games/create', [\App\Http\Controllers\AdminController::class, 'createGame'])->name('admin.games.create');
    Route::post('/games', [\App\Http\Controllers\AdminController::class, 'storeGame'])->name('admin.games.store');
    Route::get('/games/{id}/edit', [\App\Http\Controllers\AdminController::class, 'editGame'])->name('admin.games.edit');
    Route::put('/games/{id}', [\App\Http\Controllers\AdminController::class, 'updateGame'])->name('admin.games.update');
    Route::delete('/games/{id}', [\App\Http\Controllers\AdminController::class, 'deleteGame'])->name('admin.games.delete');
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

// Temporary route to fix database schema
Route::get('/fix-database', function() {
    try {
        if (!Schema::hasColumn('users', 'banner')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('banner')->nullable()->after('photo');
            });
            return "Banner column added successfully!";
        } else {
            return "Banner column already exists.";
        }
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});
