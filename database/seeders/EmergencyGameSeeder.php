<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class EmergencyGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            Log::info('Starting EmergencyGameSeeder');
            // Check if games table exists
            if (!Schema::hasTable('games')) {
                Log::error('Games table does not exist');
                return;
            }
            
            // Check if we already have games
            $count = Game::count();
            Log::info("Current game count: {$count}");
            
            if ($count >= 10) {
                Log::info('Sufficient games already in database, skipping seeding');
                return;
            }
            
            // Sample games to ensure all categories are covered
            $games = [
                [
                    'title' => 'Cyberpunk 2077',
                    'description' => 'Open-world, action-adventure RPG set in the megalopolis of Night City',
                    'category' => 'Aksiyon, RPG, Açık Dünya',
                    'price' => 499.99,
                    'discount_price' => 374.99,
                    'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1091500/header.jpg',
                    'release_date' => '2020-12-10',
                    'developer' => 'CD Projekt Red',
                    'publisher' => 'CD Projekt'
                ],
                [
                    'title' => 'FIFA 23',
                    'description' => 'The most realistic football gaming experience',
                    'category' => 'Spor, Simulasyon',
                    'price' => 699.99,
                    'discount_price' => null,
                    'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1811260/header.jpg',
                    'release_date' => '2022-09-30',
                    'developer' => 'EA Vancouver',
                    'publisher' => 'Electronic Arts'
                ],
                [
                    'title' => 'Resident Evil Village',
                    'description' => 'Survival horror game developed and published by Capcom',
                    'category' => 'Korku, Hayatta Kalma',
                    'price' => 499.99,
                    'discount_price' => 399.99,
                    'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1196590/header.jpg',
                    'release_date' => '2021-05-07',
                    'developer' => 'Capcom',
                    'publisher' => 'Capcom'
                ],
                [
                    'title' => 'Age of Empires IV',
                    'description' => 'Real-time strategy game developed by Relic Entertainment',
                    'category' => 'Strateji, RTS',
                    'price' => 249.99,
                    'discount_price' => 124.99,
                    'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1466860/header.jpg',
                    'release_date' => '2021-10-28',
                    'developer' => 'Relic Entertainment',
                    'publisher' => 'Xbox Game Studios'
                ],
                [
                    'title' => 'Call of Duty: Modern Warfare II',
                    'description' => 'First-person shooter game and the sequel to 2019\'s Modern Warfare',
                    'category' => 'Aksiyon, FPS',
                    'price' => 699.99,
                    'discount_price' => 594.99,
                    'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1938090/header.jpg',
                    'release_date' => '2022-10-28',
                    'developer' => 'Infinity Ward',
                    'publisher' => 'Activision'
                ],
            ];
            
            foreach ($games as $game) {
                // Create the slug
                $slug = Str::slug($game['title']);
                
                // Check if this game already exists (by slug)
                if (Game::where('slug', $slug)->exists()) {
                    Log::info("Game '{$game['title']}' already exists, skipping");
                    continue;
                }
                
                // Create new game
                Game::create([
                    'title' => $game['title'],
                    'slug' => $slug,
                    'description' => $game['description'],
                    'category' => $game['category'],
                    'price' => $game['price'],
                    'discount_price' => $game['discount_price'],
                    'image' => $game['image'],
                    'release_date' => $game['release_date'],
                    'developer' => $game['developer'],
                    'publisher' => $game['publisher'],
                ]);
                
                Log::info("Added game: {$game['title']}");
            }
            
            Log::info('EmergencyGameSeeder completed successfully');
        } catch (\Exception $e) {
            Log::error('Error in EmergencyGameSeeder: ' . $e->getMessage());
        }
    }
} 