<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Support\Facades\Log;

class GameFeaturesUpdater extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::info('Starting GameFeaturesUpdater');
        Log::info('Current game count: ' . Game::count());
        
        $gameUpdates = [
            'cyberpunk-2077' => [
                'category' => 'Rol Yapma, Aksiyon, Açık Dünya',
                'developer' => 'CD Projekt Red',
                'publisher' => 'CD Projekt',
                'price' => 499.99,
                'discount_price' => 374.99,
            ],
            'resident-evil-village' => [
                'category' => 'Korku, Hayatta Kalma, Birinci Şahıs',
                'developer' => 'Capcom',
                'publisher' => 'Capcom',
                'price' => 499.00,
                'discount_price' => 399.00,
            ],
            'age-of-empires-iv' => [
                'category' => 'Strateji, Tarih, Gerçek Zamanlı',
                'developer' => 'Relic Entertainment',
                'publisher' => 'Xbox Game Studios',
                'price' => 249.00,
                'discount_price' => 124.50,
            ],
            'call-of-duty-modern-warfare-ii' => [
                'category' => 'FPS, Aksiyon, Çok Oyunculu',
                'developer' => 'Infinity Ward',
                'publisher' => 'Activision',
                'price' => 699.00,
                'discount_price' => 594.15,
            ],
            'elden-ring' => [
                'category' => 'Rol Yapma, Aksiyon, Açık Dünya, Zorlayıcı',
                'developer' => 'FromSoftware',
                'publisher' => 'Bandai Namco',
                'price' => 599.99,
                'discount_price' => null,
            ],
            'the-witcher-3' => [
                'category' => 'Rol Yapma, Açık Dünya, Macera, Fantastik',
                'developer' => 'CD Projekt Red',
                'publisher' => 'CD Projekt',
                'price' => 150.00,
                'discount_price' => 75.00,
            ],
            'god-of-war' => [
                'category' => 'Aksiyon, Macera, Hikaye Odaklı',
                'developer' => 'Santa Monica Studio',
                'publisher' => 'Sony Interactive Entertainment',
                'price' => 329.99,
                'discount_price' => null,
            ],
            'batman-arkham-knight' => [
                'category' => 'Aksiyon, Macera, Süper Kahraman',
                'developer' => 'Rocksteady Studios',
                'publisher' => 'Warner Bros. Interactive Entertainment',
                'price' => 149.99,
                'discount_price' => 49.99,
            ],
            'fifa-23' => [
                'category' => 'Spor, Futbol, Simülasyon',
                'developer' => 'EA Vancouver',
                'publisher' => 'Electronic Arts',
                'price' => 699.99,
                'discount_price' => null,
            ],
            'f1-2022' => [
                'category' => 'Yarış, Spor, Simülasyon',
                'developer' => 'Codemasters',
                'publisher' => 'EA Sports',
                'price' => 399.99,
                'discount_price' => 199.99,
            ],
            'civilization-vi' => [
                'category' => 'Strateji, Sıra Tabanlı, 4X',
                'developer' => 'Firaxis Games',
                'publisher' => '2K Games',
                'price' => 250.00,
                'discount_price' => 99.99,
            ],
            'crusader-kings-iii' => [
                'category' => 'Strateji, Simülasyon, Rol Yapma, Tarih',
                'developer' => 'Paradox Development Studio',
                'publisher' => 'Paradox Interactive',
                'price' => 349.99,
                'discount_price' => null,
            ],
            'outlast' => [
                'category' => 'Korku, Hayatta Kalma, Birinci Şahıs',
                'developer' => 'Red Barrels',
                'publisher' => 'Red Barrels',
                'price' => 89.99,
                'discount_price' => 29.99,
            ],
            'layers-of-fear' => [
                'category' => 'Korku, Psikolojik, Macera, Birinci Şahıs',
                'developer' => 'Bloober Team',
                'publisher' => 'Aspyr',
                'price' => 129.99,
                'discount_price' => 64.99,
            ],
            'counter-strike-2' => [
                'category' => 'FPS, Aksiyon, Çok Oyunculu, Rekabetçi',
                'developer' => 'Valve',
                'publisher' => 'Valve',
                'price' => 0,
                'discount_price' => null,
            ],
            'dota-2' => [
                'category' => 'MOBA, Strateji, Çok Oyunculu, Rekabetçi',
                'developer' => 'Valve',
                'publisher' => 'Valve',
                'price' => 0,
                'discount_price' => null,
            ],
            'apex-legends' => [
                'category' => 'FPS, Battle Royale, Aksiyon, Çok Oyunculu',
                'developer' => 'Respawn Entertainment',
                'publisher' => 'Electronic Arts',
                'price' => 0,
                'discount_price' => null,
            ],
            'fortnite' => [
                'category' => 'Battle Royale, Aksiyon, Çok Oyunculu, Üçüncü Şahıs',
                'developer' => 'Epic Games',
                'publisher' => 'Epic Games',
                'price' => 0,
                'discount_price' => null,
            ],
            'war-thunder' => [
                'category' => 'Simülasyon, Savaş, Aksiyon, Çok Oyunculu, Ücretsiz',
                'developer' => 'Gaijin Entertainment',
                'publisher' => 'Gaijin Entertainment',
                'price' => 0,
                'discount_price' => null,
            ],
        ];
        
        foreach ($gameUpdates as $slug => $updates) {
            try {
                $game = Game::where('slug', $slug)->first();
                
                if ($game) {
                    $game->category = $updates['category'];
                    $game->developer = $updates['developer'];
                    $game->publisher = $updates['publisher'];
                    $game->price = $updates['price'];
                    $game->discount_price = $updates['discount_price'];
                    $game->save();
                    
                    Log::info('Updated features for game: ' . $game->title);
                } else {
                    Log::warning('Game not found: ' . $slug);
                }
            } catch (\Exception $e) {
                Log::error('Error updating features for game ' . $slug . ': ' . $e->getMessage());
            }
        }
        
        Log::info('GameFeaturesUpdater completed successfully');
    }
} 