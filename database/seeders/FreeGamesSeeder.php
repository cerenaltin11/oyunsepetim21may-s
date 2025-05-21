<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Support\Str;

class FreeGamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = [
            [
                'title' => 'War Thunder',
                'description' => 'War Thunder, II. Dünya Savaşı\'ndan modern savaş araçlarına kadar geniş bir yelpazede savaş simülasyonu sunan ücretsiz bir oyundur. Tanklar, uçaklar ve gemilerle savaşın.',
                'category' => 'Simülasyon, Aksiyon',
                'price' => 0.00,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/236390/header.jpg',
                'release_date' => '2013-08-15',
                'developer' => 'Gaijin Entertainment',
                'publisher' => 'Gaijin Entertainment'
            ],
            [
                'title' => 'Dota 2',
                'description' => 'Dota 2, Valve tarafından geliştirilen ücretsiz bir MOBA oyunudur. Stratejik düşünme ve takım çalışması gerektiren rekabetçi bir oyun deneyimi sunar.',
                'category' => 'MOBA, Strateji',
                'price' => 0.00,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/570/header.jpg',
                'release_date' => '2013-07-09',
                'developer' => 'Valve',
                'publisher' => 'Valve'
            ],
            [
                'title' => 'Counter-Strike 2',
                'description' => 'Counter-Strike 2, Valve\'ın ücretsiz FPS oyunudur. Terörist ve anti-terörist takımları arasında geçen taktiksel savaş simülasyonu.',
                'category' => 'FPS, Aksiyon',
                'price' => 0.00,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/730/header.jpg',
                'release_date' => '2012-08-21',
                'developer' => 'Valve',
                'publisher' => 'Valve'
            ],
            [
                'title' => 'Path of Exile',
                'description' => 'Path of Exile, ücretsiz bir aksiyon rol yapma oyunudur. Karanlık fantezi dünyasında geçen, derin karakter geliştirme sistemi sunan bir ARPG.',
                'category' => 'ARPG, Aksiyon',
                'price' => 0.00,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/238960/header.jpg',
                'release_date' => '2013-10-23',
                'developer' => 'Grinding Gear Games',
                'publisher' => 'Grinding Gear Games'
            ],
            [
                'title' => 'Team Fortress 2',
                'description' => 'Team Fortress 2, Valve\'ın ücretsiz takım tabanlı FPS oyunudur. Farklı sınıflar ve eğlenceli oynanış mekanikleriyle öne çıkar.',
                'category' => 'FPS, Aksiyon',
                'price' => 0.00,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/440/header.jpg',
                'release_date' => '2007-10-10',
                'developer' => 'Valve',
                'publisher' => 'Valve'
            ],
            [
                'title' => 'Destiny 2',
                'description' => 'Destiny 2, Bungie tarafından geliştirilen ücretsiz bir MMO-FPS oyunudur. Uzayda geçen, looter-shooter türünde bir oyun deneyimi sunar.',
                'category' => 'FPS, MMO',
                'price' => 0.00,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1085660/header.jpg',
                'release_date' => '2019-10-01',
                'developer' => 'Bungie',
                'publisher' => 'Bungie'
            ],
            [
                'title' => 'Apex Legends',
                'description' => 'Apex Legends, Electronic Arts tarafından geliştirilen ücretsiz bir battle royale oyunudur. Hızlı tempolu oynanışı ve özel yetenekleriyle öne çıkar.',
                'category' => 'Battle Royale, FPS',
                'price' => 0.00,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1172470/header.jpg',
                'release_date' => '2020-11-05',
                'developer' => 'Respawn Entertainment',
                'publisher' => 'Electronic Arts'
            ],
            [
                'title' => 'Warframe',
                'description' => 'Warframe, Digital Extremes tarafından geliştirilen ücretsiz bir aksiyon-rol yapma oyunudur. Uzay ninjaları olarak görev yapan Tenno\'ların hikayesini anlatır.',
                'category' => 'Aksiyon, RPG',
                'price' => 0.00,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/230410/header.jpg',
                'release_date' => '2013-03-25',
                'developer' => 'Digital Extremes',
                'publisher' => 'Digital Extremes'
            ],
            [
                'title' => 'Genshin Impact',
                'description' => 'Genshin Impact, miHoYo tarafından geliştirilen ücretsiz bir açık dünya RPG oyunudur. Anime tarzı grafikleri ve element tabanlı savaş sistemiyle öne çıkar.',
                'category' => 'RPG, Açık Dünya',
                'price' => 0.00,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1687950/header.jpg',
                'release_date' => '2020-09-28',
                'developer' => 'miHoYo',
                'publisher' => 'miHoYo'
            ],
            [
                'title' => 'Hearthstone',
                'description' => 'Hearthstone, Blizzard Entertainment tarafından geliştirilen ücretsiz bir dijital kart oyunudur. Warcraft evreninde geçen, stratejik düşünme gerektiren bir oyun.',
                'category' => 'Kart Oyunu, Strateji',
                'price' => 0.00,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1463420/header.jpg',
                'release_date' => '2014-03-11',
                'developer' => 'Blizzard Entertainment',
                'publisher' => 'Blizzard Entertainment'
            ],
        ];

        foreach ($games as $game) {
            Game::updateOrCreate(
                ['slug' => Str::slug($game['title'])],
                $game
            );
        }
    }
} 