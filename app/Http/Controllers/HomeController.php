<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // No middleware needed for the home page
    }

    /**
     * Display the home page with featured games.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // Check if Game model exists
            if (!class_exists(Game::class)) {
                Log::error('Game model class does not exist');
                return view('home', ['error' => 'Game model not found']);
            }
            
            // Get popular games
            $popularGames = Game::orderBy('created_at', 'desc')->take(4)->get();
            
            // Get action games
            $actionGames = Game::where('category', 'LIKE', '%Aksiyon%')->take(5)->get();
            
            // Get RPG games
            $rpgGames = Game::where('category', 'LIKE', '%RPG%')->take(3)->get();
            
            // Get sport and racing games
            $sportGames = Game::where('category', 'LIKE', '%Spor%')
                ->orWhere('category', 'LIKE', '%Yarış%')
                ->take(3)
                ->get();
            
            // Get horror games
            $horrorGames = Game::where('category', 'LIKE', '%Korku%')->take(3)->get();
            
            // Get strategy games
            $strategyGames = Game::where('category', 'LIKE', '%Strateji%')->take(5)->get();
            
            // Get user's library games if user is logged in
            $libraryGames = [];
            if (Auth::check()) {
                $libraryGames = Session::get('library', []);
            }
            
            // Debug information
            Log::info('Home page loaded with games: ' . 
                'Popular: ' . $popularGames->count() . ', ' .
                'Action: ' . $actionGames->count() . ', ' .
                'RPG: ' . $rpgGames->count() . ', ' .
                'Sport: ' . $sportGames->count() . ', ' .
                'Horror: ' . $horrorGames->count() . ', ' .
                'Strategy: ' . $strategyGames->count()
            );
            
            return view('home', [
                'popularGames' => $popularGames,
                'actionGames' => $actionGames,
                'rpgGames' => $rpgGames,
                'sportGames' => $sportGames,
                'horrorGames' => $horrorGames,
                'strategyGames' => $strategyGames,
                'libraryGames' => $libraryGames
            ]);
        } catch (\Exception $e) {
            Log::error('Error in HomeController@index: ' . $e->getMessage());
            return view('home', ['error' => 'An error occurred while loading games']);
        }
    }
} 