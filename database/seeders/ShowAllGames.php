<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Support\Facades\Log;

class ShowAllGames extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = Game::all();
        
        Log::info('Total games: ' . $games->count());
        Log::info('------------------------------');
        
        foreach ($games as $game) {
            Log::info('Title: ' . $game->title);
            Log::info('Slug: ' . $game->slug);
            Log::info('Category: ' . $game->category);
            Log::info('Price: ' . $game->price);
            Log::info('Discount: ' . ($game->discount_price ?? 'None'));
            Log::info('------------------------------');
        }
        
        Log::info('All games listed successfully');
    }
} 