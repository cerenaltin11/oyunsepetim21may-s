<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the games.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $sort = $request->input('sort', 'title');
        $direction = $request->input('direction', 'asc');
        
        $query = Game::query();
        
        // Arama filtresini uygula
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('category', 'LIKE', "%{$search}%");
            });
        }
        
        // Kategori filtresini uygula
        if ($category && $category != 'all') {
            $query->where('category', 'LIKE', "%{$category}%");
        }
        
        // Sıralamayı uygula
        $validSortFields = ['title', 'price', 'release_date'];
        $validDirections = ['asc', 'desc'];
        
        if (in_array($sort, $validSortFields) && in_array($direction, $validDirections)) {
            $query->orderBy($sort, $direction);
        } else {
            $query->orderBy('title', 'asc');
        }
        
        $games = $query->paginate(12);
        
        // Mevcut kategorileri al
        $categories = Game::select('category')
            ->distinct()
            ->get()
            ->pluck('category')
            ->filter()
            ->values();
        
        // Her kategori değerini parçala
        $uniqueCategories = collect();
        foreach ($categories as $categoryString) {
            $categoryParts = array_map('trim', explode(',', $categoryString));
            foreach ($categoryParts as $part) {
                if (!$uniqueCategories->contains($part)) {
                    $uniqueCategories->push($part);
                }
            }
        }
        
        // Kullanıcının kütüphanesindeki oyunları al
        $libraryGames = [];
        if (Auth::check()) {
            $libraryGames = Session::get('library', []);
        }
        
        return view('games.index', compact('games', 'search', 'category', 'sort', 'direction', 'uniqueCategories', 'libraryGames'));
    }
    
    /**
     * Display the specified game.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        
        // Kullanıcının oyunu zaten sahip olup olmadığını kontrol et
        $hasGame = false;
        if (Auth::check()) {
            $library = Session::get('library', []);
            $hasGame = in_array($game->id, $library);
        }
        
        return view('games.detail', compact('game', 'hasGame'));
    }
    
    /**
     * Search for games based on query - for AJAX requests
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->input('query');
        
        \Log::info('Game search query: ' . $search);
        
        if (empty($search)) {
            return response()->json([]);
        }
        
        $games = Game::where('title', 'LIKE', "%{$search}%")
                      ->orWhere('category', 'LIKE', "%{$search}%")
                      ->limit(5)
                      ->get(['id', 'title', 'slug', 'category', 'price', 'discount_price', 'image']);
        
        \Log::info('Games found: ' . $games->count());
        
        return response()->json($games);
    }
} 