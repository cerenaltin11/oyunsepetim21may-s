<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Constructor to apply middleware.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    /**
     * Display admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalUsers = User::count();
        $totalGames = Game::count();
        $totalReviews = Review::count();
        
        $recentUsers = User::latest()->take(5)->get();
        
        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalGames' => $totalGames,
            'totalReviews' => $totalReviews,
            'recentUsers' => $recentUsers
        ]);
    }
    
    /**
     * Display panel home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function panel()
    {
        // Ekstra güvenlik kontrolü
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Bu sayfaya erişim yetkiniz bulunmuyor.');
        }
        
        $totalUsers = User::count();
        $totalGames = Game::count();
        $totalReviews = Review::count();
        
        $recentUsers = User::latest()->take(5)->get();
        $recentGames = Game::latest()->take(5)->get();
        
        return view('admin.panel', [
            'totalUsers' => $totalUsers,
            'totalGames' => $totalGames,
            'totalReviews' => $totalReviews,
            'recentUsers' => $recentUsers,
            'recentGames' => $recentGames
        ]);
    }
    
    /**
     * Display user management page.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        $users = User::paginate(10);
        
        return view('admin.users', [
            'users' => $users
        ]);
    }
    
    /**
     * Toggle admin status for a user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleAdmin($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent removing admin status from self
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Kendi admin statünüzü değiştiremezsiniz.');
        }
        
        $user->is_admin = !$user->is_admin;
        $user->save();
        
        return redirect()->back()->with('success', 'Kullanıcının admin statüsü güncellendi.');
    }
    
    /**
     * Display user activity details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userActivity($id)
    {
        $user = User::findOrFail($id);
        
        // Get user's library (purchased games)
        $libraryGames = session("user_{$id}_library", []);
        $libraryItems = [];
        
        if (!empty($libraryGames)) {
            foreach ($libraryGames as $gameId) {
                $game = Game::find($gameId);
                if ($game) {
                    // Add random play time for demo
                    $game->play_time = rand(0, 100);
                    $game->last_played = rand(0, 10) > 3 ? now()->subDays(rand(1, 30))->format('d.m.Y') : null;
                    $libraryItems[] = $game;
                }
            }
        }
        
        // Get user's reviews
        $reviews = $user->reviews()->with('game')->latest()->get();
        
        // Get user's orders
        $orders = session("user_{$id}_orders", []);
        
        return view('admin.user-activity', [
            'user' => $user,
            'libraryItems' => $libraryItems,
            'reviews' => $reviews,
            'orders' => $orders
        ]);
    }
    
    /**
     * Display games management page.
     *
     * @return \Illuminate\Http\Response
     */
    public function games()
    {
        $games = Game::orderBy('title')->paginate(10);
        
        return view('admin.games', [
            'games' => $games
        ]);
    }
    
    /**
     * Show the form for creating a new game.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGame()
    {
        return view('admin.games-create');
    }
    
    /**
     * Store a newly created game in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGame(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'release_date' => 'required|date',
            'developer' => 'required|string|max:100',
            'publisher' => 'required|string|max:100',
        ]);
        
        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('games', 'public');
        }
        
        // Create game with slug
        $slug = Str::slug($request->title);
        
        // Check if slug exists, if so, append a random number
        if (Game::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . rand(1000, 9999);
        }
        
        Game::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'category' => $request->category,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'image' => $imagePath,
            'release_date' => $request->release_date,
            'developer' => $request->developer,
            'publisher' => $request->publisher,
        ]);
        
        return redirect()->route('admin.games')->with('success', 'Oyun başarıyla eklendi.');
    }
    
    /**
     * Show the form for editing the specified game.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editGame($id)
    {
        $game = Game::findOrFail($id);
        
        return view('admin.games-edit', [
            'game' => $game
        ]);
    }
    
    /**
     * Update the specified game in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateGame(Request $request, $id)
    {
        $game = Game::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'release_date' => 'required|date',
            'developer' => 'required|string|max:100',
            'publisher' => 'required|string|max:100',
        ]);
        
        // Handle image upload if new image provided
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($game->image) {
                Storage::disk('public')->delete($game->image);
            }
            $imagePath = $request->file('image')->store('games', 'public');
            $game->image = $imagePath;
        }
        
        $game->title = $request->title;
        // Only update slug if title changed
        if ($game->title != $request->title) {
            $slug = Str::slug($request->title);
            
            // Check if slug exists, if so, append a random number
            if (Game::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $slug . '-' . rand(1000, 9999);
            }
            $game->slug = $slug;
        }
        
        $game->description = $request->description;
        $game->category = $request->category;
        $game->price = $request->price;
        $game->discount_price = $request->discount_price;
        $game->release_date = $request->release_date;
        $game->developer = $request->developer;
        $game->publisher = $request->publisher;
        
        $game->save();
        
        return redirect()->route('admin.games')->with('success', 'Oyun başarıyla güncellendi.');
    }
    
    /**
     * Remove the specified game from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteGame($id)
    {
        $game = Game::findOrFail($id);
        
        // Delete image if exists
        if ($game->image) {
            Storage::disk('public')->delete($game->image);
        }
        
        // Delete related reviews
        $game->reviews()->delete();
        
        // Delete the game
        $game->delete();
        
        return redirect()->route('admin.games')->with('success', 'Oyun başarıyla silindi.');
    }
}
