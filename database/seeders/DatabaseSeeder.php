<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            GameSeeder::class,
            GamesTableSeeder::class,
            EmergencyGameSeeder::class,
            BadgeSeeder::class,
            FreeGamesSeeder::class,
        ]);

        // Add test data for a free game if none exists
        $freeGameCount = \App\Models\Game::where('price', 0)->count();
        
        if ($freeGameCount == 0) {
            \App\Models\Game::create([
                'title' => 'Bedava Test Oyunu',
                'slug' => 'bedava-test-oyunu',
                'description' => 'Bu bir test ücretsiz oyunudur',
                'category' => 'Aksiyon, Macera',
                'price' => 0,
                'discount_price' => null,
                'image' => 'https://picsum.photos/400/600',
                'release_date' => now(),
                'developer' => 'Test Developer',
                'publisher' => 'Test Publisher',
            ]);
            
            \Log::info('Free test game created');
        }
    }
}
