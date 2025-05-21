<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Support\Facades\Log;

class AdditionalGamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::info('Starting AdditionalGamesSeeder');
        Log::info('Current game count: ' . Game::count());
        
        // Tüm oyunları bir array içinde tanımlayalım
        $games = [
            // RPG Oyunları
            [
                'title' => 'Elden Ring',
                'slug' => 'elden-ring',
                'description' => 'Elden Ring is an action RPG which takes place in the Lands Between, sometime after the Shattering of the titular Elden Ring.',
                'category' => 'RPG, Aksiyon, Açık Dünya',
                'price' => 599.99,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1245620/header.jpg',
                'release_date' => '2022-02-25',
                'developer' => 'FromSoftware',
                'publisher' => 'Bandai Namco'
            ],
            [
                'title' => 'The Witcher 3: Wild Hunt',
                'slug' => 'the-witcher-3',
                'description' => 'The Witcher 3: Wild Hunt is a 2015 action role-playing game developed and published by Polish developer CD Projekt Red.',
                'category' => 'RPG, Açık Dünya, Macera',
                'price' => 150.00,
                'discount_price' => 75.00,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/292030/header.jpg',
                'release_date' => '2015-05-19',
                'developer' => 'CD Projekt Red',
                'publisher' => 'CD Projekt'
            ],
            
            // Aksiyon Oyunları
            [
                'title' => 'God of War',
                'slug' => 'god-of-war',
                'description' => 'God of War is an action-adventure game franchise created by David Jaffe at Sony\'s Santa Monica Studio.',
                'category' => 'Aksiyon, Macera',
                'price' => 329.99,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1593500/header.jpg',
                'release_date' => '2022-01-14',
                'developer' => 'Santa Monica Studio',
                'publisher' => 'Sony Interactive Entertainment'
            ],
            [
                'title' => 'Batman: Arkham Knight',
                'slug' => 'batman-arkham-knight',
                'description' => 'Batman: Arkham Knight is a 2015 action-adventure game developed by Rocksteady Studios.',
                'category' => 'Aksiyon, Macera',
                'price' => 149.99,
                'discount_price' => 49.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/208650/header.jpg',
                'release_date' => '2015-06-23',
                'developer' => 'Rocksteady Studios',
                'publisher' => 'Warner Bros. Interactive Entertainment'
            ],
            
            // Spor ve Yarış Oyunları
            [
                'title' => 'FIFA 23',
                'slug' => 'fifa-23',
                'description' => 'FIFA 23 is a football simulation video game published by Electronic Arts.',
                'category' => 'Spor',
                'price' => 699.99,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1811260/header.jpg',
                'release_date' => '2022-09-30',
                'developer' => 'EA Vancouver',
                'publisher' => 'Electronic Arts'
            ],
            [
                'title' => 'F1 2022',
                'slug' => 'f1-2022',
                'description' => 'Experience the thrill of Formula 1 with F1 2022, the official videogame of the 2022 FIA Formula One World Championship.',
                'category' => 'Yarış, Spor, Simülasyon',
                'price' => 399.99,
                'discount_price' => 199.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1708600/header.jpg',
                'release_date' => '2022-07-01',
                'developer' => 'Codemasters',
                'publisher' => 'EA Sports'
            ],
            
            // Strateji Oyunları
            [
                'title' => 'Civilization VI',
                'slug' => 'civilization-vi',
                'description' => 'Civilization VI is a turn-based strategy game in which one player takes control of a civilization from the Stone Age to the Information Age.',
                'category' => 'Strateji, Sıra Tabanlı',
                'price' => 250.00,
                'discount_price' => 99.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/289070/header.jpg',
                'release_date' => '2016-10-21',
                'developer' => 'Firaxis Games',
                'publisher' => '2K Games'
            ],
            [
                'title' => 'Crusader Kings III',
                'slug' => 'crusader-kings-iii',
                'description' => 'Crusader Kings III is a grand strategy game and RPG set in the Middle Ages, developed by Paradox Development Studio.',
                'category' => 'Strateji, Simülasyon, RPG',
                'price' => 349.99,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1158310/header.jpg',
                'release_date' => '2020-09-01',
                'developer' => 'Paradox Development Studio',
                'publisher' => 'Paradox Interactive'
            ],
            
            // Korku Oyunları
            [
                'title' => 'Outlast',
                'slug' => 'outlast',
                'description' => 'Outlast is a first-person survival horror video game developed and published by Red Barrels.',
                'category' => 'Korku, Hayatta Kalma',
                'price' => 89.99,
                'discount_price' => 29.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/238320/header.jpg',
                'release_date' => '2013-09-04',
                'developer' => 'Red Barrels',
                'publisher' => 'Red Barrels'
            ],
            [
                'title' => 'Layers of Fear',
                'slug' => 'layers-of-fear',
                'description' => 'Layers of Fear is a first-person psychedelic horror game with a heavy focus on story and exploration.',
                'category' => 'Korku, Psikolojik, Macera',
                'price' => 129.99,
                'discount_price' => 64.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/391720/header.jpg',
                'release_date' => '2016-02-16',
                'developer' => 'Bloober Team',
                'publisher' => 'Aspyr'
            ],
            
            // Ücretsiz Oyunlar
            [
                'title' => 'Counter-Strike 2',
                'slug' => 'counter-strike-2',
                'description' => 'Counter-Strike 2 is a free-to-play multiplayer tactical first-person shooter developed by Valve.',
                'category' => 'FPS, Aksiyon, Çok Oyunculu',
                'price' => 0,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/730/header.jpg',
                'release_date' => '2023-09-27',
                'developer' => 'Valve',
                'publisher' => 'Valve'
            ],
            [
                'title' => 'Dota 2',
                'slug' => 'dota-2',
                'description' => 'Dota 2 is a multiplayer online battle arena (MOBA) game developed and published by Valve.',
                'category' => 'MOBA, Strateji, Çok Oyunculu',
                'price' => 0,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/570/header.jpg',
                'release_date' => '2013-07-09',
                'developer' => 'Valve',
                'publisher' => 'Valve'
            ],
            [
                'title' => 'Apex Legends',
                'slug' => 'apex-legends',
                'description' => 'Apex Legends is a free-to-play battle royale-hero shooter game developed by Respawn Entertainment and published by Electronic Arts.',
                'category' => 'FPS, Battle Royale, Aksiyon',
                'price' => 0,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1172470/header.jpg',
                'release_date' => '2020-11-05',
                'developer' => 'Respawn Entertainment',
                'publisher' => 'Electronic Arts'
            ],
            [
                'title' => 'Fortnite',
                'slug' => 'fortnite',
                'description' => 'Fortnite is a free-to-play Battle Royale game with numerous game modes for every type of game player.',
                'category' => 'Battle Royale, Aksiyon, Çok Oyunculu',
                'price' => 0,
                'discount_price' => null,
                'image' => 'https://cdn2.unrealengine.com/social-image-chapter4-s3-3840x2160-d35912cc25ad.jpg',
                'release_date' => '2017-07-25',
                'developer' => 'Epic Games',
                'publisher' => 'Epic Games'
            ],
            [
                'title' => 'War Thunder',
                'slug' => 'war-thunder',
                'description' => 'War Thunder is a free-to-play vehicular combat multiplayer video game developed by Gaijin Entertainment. The game is based around combined arms battles on air, land, and sea with vehicles from the Spanish Civil War to the Cold War period.',
                'category' => 'Simülasyon, Savaş, Aksiyon, Çok Oyunculu, Ücretsiz',
                'price' => 0,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/236390/header.jpg',
                'release_date' => '2013-08-15',
                'developer' => 'Gaijin Entertainment',
                'publisher' => 'Gaijin Entertainment'
            ],
        ];
        
        // Her oyunu ayrı ayrı eklemeyi deneyelim
        foreach ($games as $game) {
            try {
                $existingGame = Game::where('slug', $game['slug'])->first();
                
                if (!$existingGame) {
                    Game::create($game);
                    Log::info('Added game: ' . $game['title']);
                } else {
                    Log::info('Game already exists: ' . $game['title']);
                }
            } catch (\Exception $e) {
                Log::error('Error adding game ' . $game['title'] . ': ' . $e->getMessage());
            }
        }
        
        Log::info('AdditionalGamesSeeder completed successfully');
    }
} 