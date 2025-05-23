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
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');

// About page
Route::get('/about', function() {
    return view('about');
})->name('about');

// Contact page
Route::get('/contact', function() {
    return view('contact');
})->name('contact');

// Privacy Policy page
Route::get('/privacy', function() {
    return view('privacy');
})->name('privacy');

// Terms of Service page
Route::get('/terms', function() {
    return view('terms');
})->name('terms');

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
Route::get('/library', [\App\Http\Controllers\LibraryController::class, 'index'])->name('library');

// Library routes
Route::get('/library/download/{gameId}', [\App\Http\Controllers\LibraryController::class, 'download'])->name('library.download');
Route::post('/library/add-direct', [\App\Http\Controllers\LibraryController::class, 'addDirect'])->name('library.add_direct');
Route::get('/library/game/{gameId}', [\App\Http\Controllers\LibraryController::class, 'gameDetail'])->name('library.game');

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
    
    // Library routes
    Route::get('/library/download/{gameId}', [\App\Http\Controllers\LibraryController::class, 'download'])->name('library.download');
    Route::post('/library/add-direct', [\App\Http\Controllers\LibraryController::class, 'addDirect'])->name('library.add_direct');
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
        
        // Track login for daily reward system
        $user = \Illuminate\Support\Facades\Auth::user();
        
        // Only update login tracking if it's a new day or first login
        if (!$user->last_login_at || !$user->last_login_at->isToday()) {
            // Update login stats
            $lastLogin = $user->last_login_at;
            $now = now();
            
            // Update previous login time
            $user->previous_login_at = $lastLogin;
            
            // Update last login time - Ana sayfada ödül gösterilsin diye şimdilik güncelleme yapmayalım
            // $user->last_login_at = $now;
            
            // Increment login count
            $user->login_count++;
            
            // Check consecutive days
            if ($lastLogin && $now->diffInDays($lastLogin) == 1) {
                // If user logged in yesterday
                $user->consecutive_days++;
            } elseif ($lastLogin && $now->diffInDays($lastLogin) > 1) {
                // If user didn't log in yesterday, reset streak
                $user->consecutive_days = 1;
            } elseif (!$lastLogin) {
                // First login
                $user->consecutive_days = 1;
            }
            
            $user->save();
        }
        
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
        'last_login_at' => now(),
        'login_count' => 1,
        'consecutive_days' => 1,
    ]);
    
    // Give the first login badge
    $firstLoginBadge = \App\Models\Badge::where('name', 'first_login')->first();
    if ($firstLoginBadge) {
        $user->badges()->attach($firstLoginBadge->id, [
            'awarded_at' => now()
        ]);
    }
    
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
    
    // View another user's profile
    Route::get('/profile/{userId}', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    
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
Route::get('/reviews/create/{game_id}', [\App\Http\Controllers\ReviewController::class, 'create'])->name('reviews.create')->middleware('auth');

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

// Add daily reward routes
Route::get('/daily-reward/check', [\App\Http\Controllers\DailyRewardController::class, 'check'])->name('daily-reward.check');
Route::post('/daily-reward/claim', [\App\Http\Controllers\DailyRewardController::class, 'claim'])->name('daily-reward.claim');

// Add user badges route
Route::get('/profile/badges', function() {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    
    $user = auth()->user();
    
    // Check if user is admin and give admin badge
    if ($user->is_admin) {
        $adminBadge = \App\Models\Badge::where('name', 'admin_badge')->first();
        if ($adminBadge && !$user->hasBadge($adminBadge->id)) {
            $user->badges()->attach($adminBadge->id, [
                'awarded_at' => now()
            ]);
        }
    }
    
    $userBadges = $user->badges;
    $allBadges = \App\Models\Badge::all();
    
    return view('profile-badges', [
        'badges' => $userBadges,
        'allBadges' => $allBadges
    ]);
})->name('profile.badges');

// Test route to award ultimate badge (remove in production)
Route::get('/give-ultimate-badge', function() {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    
    $user = auth()->user();
    $ultimateBadge = \App\Models\Badge::where('name', 'ultimate_login')->first();
    
    if ($ultimateBadge && !$user->hasBadge($ultimateBadge->id)) {
        $user->badges()->attach($ultimateBadge->id, [
            'awarded_at' => now()
        ]);
        return "Ultimate badge awarded successfully! <a href='/profile/badges'>View your badges</a>";
    }
    
    return "You already have the ultimate badge. <a href='/profile/badges'>View your badges</a>";
});

// Test route to award admin badge (remove in production)
Route::get('/give-admin-badge', function() {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    
    $user = auth()->user();
    $adminBadge = \App\Models\Badge::where('name', 'admin_badge')->first();
    
    if ($adminBadge && !$user->hasBadge($adminBadge->id)) {
        $user->badges()->attach($adminBadge->id, [
            'awarded_at' => now()
        ]);
        return "Admin badge awarded successfully! <a href='/profile/badges'>View your badges</a>";
    }
    
    return "You already have the admin badge. <a href='/profile/badges'>View your badges</a>";
});

// Test route to toggle admin status (remove in production)
Route::get('/toggle-admin', function() {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    
    $user = auth()->user();
    $user->is_admin = !$user->is_admin;
    $user->save();
    
    // If becoming admin, also award the admin badge
    if ($user->is_admin) {
        $adminBadge = \App\Models\Badge::where('name', 'admin_badge')->first();
        if ($adminBadge && !$user->hasBadge($adminBadge->id)) {
            $user->badges()->attach($adminBadge->id, [
                'awarded_at' => now()
            ]);
        }
        return "Admin status enabled! <a href='/profile/badges'>View your badges</a>";
    } else {
        return "Admin status disabled. <a href='/profile/badges'>View your badges</a>";
    }
});

// Community routes
Route::prefix('community')->name('community.')->group(function () {
    Route::get('/', [CommunityController::class, 'index'])->name('index');
    Route::get('/create', [CommunityController::class, 'create'])->name('create')->middleware('auth');
    Route::post('/store', [CommunityController::class, 'store'])->name('store')->middleware('auth');
    Route::get('/{post}', [CommunityController::class, 'show'])->name('show');
    Route::post('/{post}/comment', [CommunityController::class, 'comment'])->name('comment')->middleware('auth');
    Route::post('/like/{type}/{id}', [CommunityController::class, 'like'])->name('like')->middleware('auth');
    Route::get('/game/{game}', [CommunityController::class, 'gameCommunity'])->name('game');
});

// Friend routes
Route::middleware(['auth'])->group(function () {
    Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
    Route::get('/friends/search', [FriendController::class, 'search'])->name('friends.search');
    Route::post('/friends/request/{user}', [FriendController::class, 'sendRequest'])->name('friends.request');
    Route::post('/friends/accept/{user}', [FriendController::class, 'acceptRequest'])->name('friends.accept');
    Route::post('/friends/reject/{user}', [FriendController::class, 'rejectRequest'])->name('friends.reject');
    Route::delete('/friends/remove/{user}', [FriendController::class, 'removeFriend'])->name('friends.remove');
    Route::post('/friends/block/{user}', [FriendController::class, 'blockUser'])->name('friends.block');
    Route::post('/friends/unblock/{user}', [FriendController::class, 'unblockUser'])->name('friends.unblock');
});

// End of routes file
