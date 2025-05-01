<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

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
}
