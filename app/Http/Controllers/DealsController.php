<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DealsController extends Controller
{
    /**
     * Display a listing of the games with discounts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category', 'all');
        $sort = $request->input('sort', 'discount_percentage');
        $direction = $request->input('direction', 'desc');
        
        $query = Game::query();
        
        // Only include games with discounts
        $query->whereNotNull('discount_price');
        
        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('category', 'LIKE', "%{$search}%");
            });
        }
        
        // Apply category filter
        if ($category && $category != 'all') {
            $query->where('category', 'LIKE', "%{$category}%");
        }
        
        // Apply sorting
        $validSortFields = ['title', 'price', 'discount_price', 'release_date'];
        $validDirections = ['asc', 'desc'];
        
        if ($sort === 'discount_percentage') {
            // Special case: Sort by discount percentage
            $query->orderByRaw('((price - discount_price) / price) * 100 ' . ($direction === 'desc' ? 'DESC' : 'ASC'));
        } elseif (in_array($sort, $validSortFields) && in_array($direction, $validDirections)) {
            $query->orderBy($sort, $direction);
        } else {
            // Default sorting: highest discount percentage
            $query->orderByRaw('((price - discount_price) / price) * 100 DESC');
        }
        
        $games = $query->paginate(12);
        
        // Get all unique categories
        $categories = Game::select('category')
            ->whereNotNull('discount_price')
            ->distinct()
            ->get()
            ->pluck('category')
            ->filter()
            ->values();
        
        // Split category strings into unique values
        $uniqueCategories = collect();
        foreach ($categories as $categoryString) {
            $categoryParts = array_map('trim', explode(',', $categoryString));
            foreach ($categoryParts as $part) {
                if (!$uniqueCategories->contains($part)) {
                    $uniqueCategories->push($part);
                }
            }
        }
        
        // Get user's library games
        $libraryGames = [];
        if (Auth::check()) {
            $libraryGames = Session::get('library', []);
        }
        
        // Generate personalized deals for logged-in users
        $personalizedDeals = collect();
        if (Auth::check()) {
            // Get some games that don't already have discounts and are not in the user's library
            $nonDiscountedGames = Game::whereNull('discount_price')
                ->whereNotIn('id', $libraryGames) // Skip games the user already owns
                ->inRandomOrder()
                ->limit(4)
                ->get();
            
            // Generate random discount percentages for each game
            foreach ($nonDiscountedGames as $game) {
                // Random discount between 10% and 50%
                $discountPercent = rand(10, 50);
                $discountedPrice = round($game->price * (1 - $discountPercent/100), 2);
                
                // Create a personalized deal with the original game data plus discount info
                $personalizedDeal = clone $game;
                $personalizedDeal->discount_price = $discountedPrice;
                $personalizedDeal->discount_percent = $discountPercent;
                $personalizedDeal->original_price = $game->price;
                $personalizedDeal->is_personalized = true;
                
                $personalizedDeals->push($personalizedDeal);
            }
        }
        
        // Pass the personalized deals to the view
        return view('games.deals', compact(
            'games', 
            'search', 
            'category', 
            'sort', 
            'direction', 
            'uniqueCategories',
            'personalizedDeals',
            'libraryGames'
        ));
    }
} 