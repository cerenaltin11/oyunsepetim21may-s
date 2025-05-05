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
        // Redirect to login if not authenticated
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Kütüphanenize erişmek için giriş yapmalısınız.');
        }
        
        // Get games from session library
        $libraryGames = Session::get('library', []);
        $libraryItems = [];
        
        // Find game details for each ID in library
        if (!empty($libraryGames)) {
            foreach ($libraryGames as $gameId) {
                $game = Game::find($gameId);
                if ($game) {
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
        $library = Session::get('library', []);
        
        foreach ($gameIds as $gameId) {
            if (!in_array($gameId, $library)) {
                $library[] = $gameId;
            }
        }
        
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
            return redirect()->back()
                ->with('error', 'Bu oyun kütüphanenizde bulunmuyor.');
        }
        
        $game = Game::find($gameId);
        if (!$game) {
            return redirect()->back()
                ->with('error', 'Oyun bulunamadı.');
        }
        
        // In a real app, this would initiate a download
        // For demo, just show a success message
        return redirect()->back()
            ->with('success', $game->title . ' oyununun indirme işlemi başlatıldı.');
    }
} 