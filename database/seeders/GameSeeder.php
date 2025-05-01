<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Support\Str;

class GameSeeder extends Seeder
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
                'title' => 'Cyberpunk 2077',
                'description' => 'Cyberpunk 2077 is a 2020 action role-playing video game developed and published by CD Projekt. The story takes place in Night City, an open world set in the Cyberpunk universe.',
                'category' => 'Aksiyon, RPG',
                'price' => 499.99,
                'discount_price' => 374.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1091500/header.jpg',
                'release_date' => '2020-12-10',
                'developer' => 'CD Projekt Red',
                'publisher' => 'CD Projekt'
            ],
            [
                'title' => 'Elden Ring',
                'description' => 'Elden Ring is an action role-playing game developed by FromSoftware and published by Bandai Namco Entertainment. The game was made in collaboration with fantasy novelist George R. R. Martin.',
                'category' => 'RPG, Souls-like',
                'price' => 599.99,
                'discount_price' => 539.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1245620/header.jpg',
                'release_date' => '2022-02-25',
                'developer' => 'FromSoftware',
                'publisher' => 'Bandai Namco Entertainment'
            ],
            [
                'title' => 'Red Dead Redemption 2',
                'description' => 'Red Dead Redemption 2 is a 2018 action-adventure game developed and published by Rockstar Games. The game is the third entry in the Red Dead series and is a prequel to the 2010 game Red Dead Redemption.',
                'category' => 'Açık Dünya, Macera',
                'price' => 349.99,
                'discount_price' => 227.49,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1174180/header.jpg',
                'release_date' => '2018-10-26',
                'developer' => 'Rockstar Games',
                'publisher' => 'Rockstar Games'
            ],
            [
                'title' => 'FIFA 23',
                'description' => 'FIFA 23 is a football simulation video game published by Electronic Arts. It is the 30th and final installment in the FIFA series.',
                'category' => 'Spor',
                'price' => 699.99,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1811260/header.jpg',
                'release_date' => '2022-09-30',
                'developer' => 'EA Vancouver',
                'publisher' => 'Electronic Arts'
            ],
            [
                'title' => 'Call of Duty: Modern Warfare',
                'description' => 'Call of Duty: Modern Warfare is a 2019 first-person shooter video game developed by Infinity Ward and published by Activision.',
                'category' => 'FPS',
                'price' => 549.99,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1938090/header.jpg',
                'release_date' => '2019-10-25',
                'developer' => 'Infinity Ward',
                'publisher' => 'Activision'
            ],
            [
                'title' => 'Forza Horizon 5',
                'description' => 'Forza Horizon 5 is a 2021 racing video game developed by Playground Games and published by Xbox Game Studios. It is the fifth Forza Horizon title and twelfth main installment in the Forza series.',
                'category' => 'Yarış',
                'price' => 449.99,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1551360/header.jpg',
                'release_date' => '2021-11-09',
                'developer' => 'Playground Games',
                'publisher' => 'Xbox Game Studios'
            ],
            [
                'title' => 'Resident Evil Village',
                'description' => 'Resident Evil Village is a 2021 first-person survival horror game developed and published by Capcom. It is the sequel to Resident Evil 7: Biohazard.',
                'category' => 'Korku',
                'price' => 499.99,
                'discount_price' => 399.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1196590/header.jpg',
                'release_date' => '2021-05-07',
                'developer' => 'Capcom',
                'publisher' => 'Capcom'
            ],
            [
                'title' => 'The Last of Us Part II',
                'description' => 'The Last of Us Part II is a 2020 action-adventure game developed by Naughty Dog and published by Sony Interactive Entertainment for the PlayStation 4.',
                'category' => 'Macera',
                'price' => 649.99,
                'discount_price' => 552.49,
                'image' => 'https://image.api.playstation.com/vulcan/ap/rnd/202206/0720/eEczyEMDd2BLa3dtkGJVE9Id.png',
                'release_date' => '2020-06-19',
                'developer' => 'Naughty Dog',
                'publisher' => 'Sony Interactive Entertainment'
            ],
            [
                'title' => 'NBA 2K23',
                'description' => 'NBA 2K23 is a basketball simulation video game developed by Visual Concepts and published by 2K Sports, based on the National Basketball Association.',
                'category' => 'Spor',
                'price' => 399.99,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1919590/header.jpg',
                'release_date' => '2022-09-09',
                'developer' => 'Visual Concepts',
                'publisher' => '2K Sports'
            ],
            [
                'title' => 'Age of Empires IV',
                'description' => 'Age of Empires IV is a real-time strategy video game developed by Relic Entertainment and published by Xbox Game Studios.',
                'category' => 'Strateji',
                'price' => 249.99,
                'discount_price' => 124.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1466860/header.jpg',
                'release_date' => '2021-10-28',
                'developer' => 'Relic Entertainment',
                'publisher' => 'Xbox Game Studios'
            ],
        ];

        foreach ($games as $game) {
            Game::create([
                'title' => $game['title'],
                'slug' => Str::slug($game['title']),
                'description' => $game['description'],
                'category' => $game['category'],
                'price' => $game['price'],
                'discount_price' => $game['discount_price'],
                'image' => $game['image'],
                'release_date' => $game['release_date'],
                'developer' => $game['developer'],
                'publisher' => $game['publisher'],
            ]);
        }
    }
}
