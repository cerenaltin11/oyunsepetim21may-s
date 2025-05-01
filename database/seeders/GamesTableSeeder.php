<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Support\Str;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Örnek oyun verileri
        $games = [
            [
                'title' => 'Cyberpunk 2077',
                'slug' => 'cyberpunk-2077',
                'description' => 'Karanlık bir gelecekte geçen, açık dünya RPG oyunu.',
                'category' => 'RPG, Aksiyon',
                'price' => 499.99,
                'discount_price' => 359.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1091500/header.jpg',
                'release_date' => '2020-12-10',
                'developer' => 'CD Projekt Red',
                'publisher' => 'CD Projekt'
            ],
            [
                'title' => 'FIFA 23',
                'slug' => 'fifa-23',
                'description' => 'En gerçekçi futbol deneyimi.',
                'category' => 'Spor',
                'price' => 699.99,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1811260/header.jpg',
                'release_date' => '2022-09-30',
                'developer' => 'EA Sports',
                'publisher' => 'Electronic Arts'
            ],
            [
                'title' => 'Elden Ring',
                'slug' => 'elden-ring',
                'description' => 'FromSoftware tarafından geliştirilen açık dünya RPG.',
                'category' => 'RPG',
                'price' => 599.99,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1245620/header.jpg',
                'release_date' => '2022-02-25',
                'developer' => 'FromSoftware',
                'publisher' => 'Bandai Namco'
            ],
            [
                'title' => 'Age of Empires IV',
                'slug' => 'age-of-empires-iv',
                'description' => 'Tarihi stratejinin son oyunu.',
                'category' => 'Strateji',
                'price' => 499.99,
                'discount_price' => 249.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1466860/header.jpg',
                'release_date' => '2021-10-28',
                'developer' => 'Relic Entertainment',
                'publisher' => 'Xbox Game Studios'
            ],
            [
                'title' => 'Call of Duty: Modern Warfare II',
                'slug' => 'call-of-duty-modern-warfare-2',
                'description' => 'Yeni nesil FPS deneyimi.',
                'category' => 'FPS, Aksiyon',
                'price' => 699.99,
                'discount_price' => 599.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1938090/header.jpg',
                'release_date' => '2022-10-28',
                'developer' => 'Infinity Ward',
                'publisher' => 'Activision'
            ],
            [
                'title' => 'Red Dead Redemption 2',
                'slug' => 'red-dead-redemption-2',
                'description' => 'Vahşi Batı\'da geçen epik bir macera.',
                'category' => 'Aksiyon, Macera',
                'price' => 599.99,
                'discount_price' => 299.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1174180/header.jpg',
                'release_date' => '2019-11-05',
                'developer' => 'Rockstar Games',
                'publisher' => 'Rockstar Games'
            ],
            [
                'title' => 'NBA 2K23',
                'slug' => 'nba-2k23',
                'description' => 'Gerçekçi basketbol simülasyonu.',
                'category' => 'Spor',
                'price' => 649.99,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1919590/header.jpg',
                'release_date' => '2022-09-09',
                'developer' => 'Visual Concepts',
                'publisher' => '2K'
            ],
            [
                'title' => 'Horizon Forbidden West',
                'slug' => 'horizon-forbidden-west',
                'description' => 'Post-apokaliptik dünyada geçen aksiyon-RPG.',
                'category' => 'Aksiyon, RPG',
                'price' => 699.99,
                'discount_price' => 499.99,
                'image' => 'https://image.api.playstation.com/vulcan/ap/rnd/202107/3100/HO8vkK9P41U7WvFa1MFLQl8S.png',
                'release_date' => '2022-02-18',
                'developer' => 'Guerrilla Games',
                'publisher' => 'Sony Interactive Entertainment'
            ],
            [
                'title' => 'God of War Ragnarök',
                'slug' => 'god-of-war-ragnarok',
                'description' => 'Kratos ve Atreus\'un İskandinav destanı.',
                'category' => 'Aksiyon, Macera',
                'price' => 799.99,
                'discount_price' => null,
                'image' => 'https://image.api.playstation.com/vulcan/ap/rnd/202207/1210/4xJ8XB3bi888QTLZYdl7Oi0s.png',
                'release_date' => '2022-11-09',
                'developer' => 'Santa Monica Studio',
                'publisher' => 'Sony Interactive Entertainment'
            ],
            [
                'title' => 'The Witcher 3: Wild Hunt',
                'slug' => 'the-witcher-3-wild-hunt',
                'description' => 'Efsanevi RPG macerası.',
                'category' => 'RPG',
                'price' => 299.99,
                'discount_price' => 99.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/292030/header.jpg',
                'release_date' => '2015-05-19',
                'developer' => 'CD Projekt Red',
                'publisher' => 'CD Projekt'
            ],
        ];

        // Verileri ekle
        foreach ($games as $game) {
            Game::updateOrCreate(
                ['slug' => $game['slug']],
                $game
            );
        }
    }
}
