<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LibraryController extends Controller
{
    /**
     * Display the user's library (purchased games)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // For demonstration, we'll use session to track purchased games
        // In a real app, this would be from a purchases/orders table in database
        $libraryGames = Session::get('library', []);
        $libraryItems = [];
        
        if (!empty($libraryGames)) {
            foreach ($libraryGames as $gameId) {
                $game = Game::find($gameId);
                if ($game) {
                    // Add some fake play time data for demo
                    $game->play_time = rand(0, 100);
                    $game->last_played = rand(0, 10) > 3 ? now()->subDays(rand(1, 30))->format('d.m.Y') : null;
                    $libraryItems[] = $game;
                }
            }
        }
        
        return view('library', [
            'libraryItems' => $libraryItems,
            'totalCount' => count($libraryItems)
        ]);
    }
    
    /**
     * Add a game to the user's library (called after successful purchase)
     *
     * @param  array  $gameIds
     * @return void
     */
    public function addGames($gameIds)
    {
        // Debug: Ensure we have game IDs
        \Log::info('Adding games to library: ', $gameIds);
        
        $library = Session::get('library', []);
        
        foreach ($gameIds as $gameId) {
            if (!in_array($gameId, $library)) {
                $library[] = $gameId;
            }
        }
        
        // Debug: Check final library state
        \Log::info('Library after adding games: ', $library);
        
        Session::put('library', $library);
    }
    
    /**
     * Download a game from the library
     *
     * @param  int  $gameId
     * @return \Illuminate\Http\Response
     */
    public function download($gameId)
    {
        $library = Session::get('library', []);
        
        if (!in_array($gameId, $library)) {
            return redirect()->back()->with('error', 'Bu oyun kütüphanenizde bulunmuyor.');
        }
        
        $game = Game::find($gameId);
        if (!$game) {
            return redirect()->back()->with('error', 'Oyun bulunamadı.');
        }
        
        // In a real app, this would initiate an actual download
        // For demo purposes, we'll just show a success message
        return redirect()->back()->with('success', $game->title . ' oyununun indirme işlemi başlatıldı.');
    }
} 