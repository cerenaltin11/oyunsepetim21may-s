<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display the wishlist page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlist = Session::get('wishlist', []);
        $wishlistItems = [];
        
        // Fetch game details for each item in wishlist
        if (!empty($wishlist)) {
            foreach ($wishlist as $gameId) {
                $game = Game::find($gameId);
                if ($game) {
                    $wishlistItems[] = $game;
                }
            }
        }
        
        return view('wishlist', [
            'wishlistItems' => $wishlistItems,
            'totalCount' => count($wishlistItems)
        ]);
    }
    
    /**
     * Add a game to the wishlist
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $validation = $request->validate([
            'game_id' => 'required|exists:games,id'
        ]);
        
        $gameId = $request->game_id;
        
        // Debug game ID
        \Log::info('Adding game to wishlist, ID: ' . $gameId);
        
        $wishlist = Session::get('wishlist', []);
        
        // Debug current wishlist
        \Log::info('Current wishlist before adding: ', $wishlist);
        
        // Check if game is already in wishlist
        if (in_array($gameId, $wishlist)) {
            return redirect()->back()->with('info', 'Bu oyun zaten istek listenizde bulunuyor.');
        }
        
        $wishlist[] = $gameId;
        Session::put('wishlist', $wishlist);
        
        // Debug updated wishlist
        \Log::info('Updated wishlist after adding: ', $wishlist);
        
        $game = Game::find($gameId);
        return redirect()->back()->with('success', "{$game->title} istek listenize başarıyla eklendi.");
    }
    
    /**
     * Remove a game from the wishlist
     *
     * @param  int  $gameId
     * @return \Illuminate\Http\Response
     */
    public function remove($gameId)
    {
        // Get current wishlist
        $wishlist = Session::get('wishlist', []);
        
        // Remove game from wishlist if it exists
        $key = array_search($gameId, $wishlist);
        if ($key !== false) {
            unset($wishlist[$key]);
            Session::put('wishlist', $wishlist);
            return redirect()->back()->with('success', 'Oyun istek listesinden kaldırıldı');
        }
        
        return redirect()->back();
    }
    
    /**
     * Clear the entire wishlist
     *
     * @return \Illuminate\Http\Response
     */
    public function clear()
    {
        Session::forget('wishlist');
        return redirect()->back()->with('success', 'İstek listesi temizlendi');
    }
    
    /**
     * Move item from wishlist to cart
     *
     * @param  int  $gameId
     * @return \Illuminate\Http\Response
     */
    public function moveToCart($gameId)
    {
        // Get current wishlist and cart
        $wishlist = Session::get('wishlist', []);
        $cart = Session::get('cart', []);
        
        // Check if game exists
        $game = Game::find($gameId);
        if (!$game) {
            return redirect()->back()->with('error', 'Oyun bulunamadı');
        }
        
        // Add to cart if not already there
        if (!isset($cart[$gameId])) {
            $cart[$gameId] = [
                'quantity' => 1,
                'is_personalized' => false
            ];
            
            // Remove from wishlist
            $key = array_search($gameId, $wishlist);
            if ($key !== false) {
                unset($wishlist[$key]);
                Session::put('wishlist', $wishlist);
            }
            
            Session::put('cart', $cart);
            return redirect()->route('cart')->with('success', 'Oyun istek listesinden sepete taşındı');
        }
        
        return redirect()->back()->with('info', 'Bu oyun zaten sepetinizde');
    }
} 