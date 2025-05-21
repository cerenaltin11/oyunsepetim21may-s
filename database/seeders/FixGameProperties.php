<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Support\Facades\Log;

class FixGameProperties extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::info('Starting FixGameProperties');
        Log::info('Current game count: ' . Game::count());
        
        $gameUpdates = [
            'cyberpunk-2077' => [
                'title' => 'Cyberpunk 2077',
                'category' => 'Rol Yapma, Aksiyon, FPS, Açık Dünya, Hikaye Odaklı',
                'description' => 'Night City\'de geçen ve ölümsüzlüğün sırrını aramak için her şeyini riske atan bir paralı asker rolünü üstlendiğiniz gelecek temalı bir açık dünya RPG oyunu.',
                'developer' => 'CD Projekt Red',
                'publisher' => 'CD Projekt',
                'price' => 499.99,
                'discount_price' => 349.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1091500/header.jpg',
            ],
            'resident-evil-village' => [
                'title' => 'Resident Evil Village',
                'category' => 'Korku, Hayatta Kalma, Birinci Şahıs, Aksiyon',
                'description' => 'Resident Evil serisinin devamı olarak, kızını kurtarmak için korkunç bir köye sürüklenen Ethan Winters\'ın macerasını yaşayın.',
                'developer' => 'Capcom',
                'publisher' => 'Capcom',
                'price' => 499.00,
                'discount_price' => 349.00,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1196590/header.jpg',
            ],
            'age-of-empires-iv' => [
                'title' => 'Age of Empires IV',
                'category' => 'Strateji, Tarih, Gerçek Zamanlı, Savaş',
                'description' => 'Dünya tarihinde iz bırakan uygarlıklardan birini seçin ve efsanevi strateji oyunu Age of Empires\'ın yeni bölümünde zafere ulaşın.',
                'developer' => 'Relic Entertainment',
                'publisher' => 'Xbox Game Studios',
                'price' => 249.00,
                'discount_price' => 174.30,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1466860/header.jpg',
            ],
            'call-of-duty-modern-warfare-ii' => [
                'title' => 'Call of Duty: Modern Warfare II',
                'category' => 'FPS, Aksiyon, Çok Oyunculu, Savaş',
                'description' => 'Modern Warfare II, yenilikçi oyun mekaniği ve gerçekçi grafiklerle özgün bir aksiyon deneyimi sunuyor.',
                'developer' => 'Infinity Ward',
                'publisher' => 'Activision',
                'price' => 699.00,
                'discount_price' => 489.00,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1938090/header.jpg',
            ],
            'elden-ring' => [
                'title' => 'Elden Ring',
                'category' => 'Rol Yapma, Aksiyon, Zorlayıcı, Açık Dünya, Fantastik',
                'description' => 'Karanlık ve Fantastik bir dünyada geçen, açık alan keşfinden karanlık ve zorlu zindanlara kadar her şeyi içeren geniş bir RPG deneyimi. Hikaye, geniş alan tamamı oynanabilir olan zindan ve diğer tehlikeli ögelerle harmanlanmıştır.',
                'developer' => 'FromSoftware',
                'publisher' => 'Bandai Namco',
                'price' => 599.99,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1245620/header.jpg',
            ],
            'the-witcher-3' => [
                'title' => 'The Witcher 3: Wild Hunt',
                'category' => 'Rol Yapma, Açık Dünya, Fantastik, Macera, Hikaye Odaklı',
                'description' => 'Paralı canavar avcısı Geralt of Rivia olarak, kayıp sevgilinizi aramak ve vahşi bir kovalamaca içindeki gizemli Vahşi Av\'a karşı koymak için geniş bir açık dünyada macera yaşayın.',
                'developer' => 'CD Projekt Red',
                'publisher' => 'CD Projekt',
                'price' => 150.00,
                'discount_price' => 45.00,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/292030/header.jpg',
            ],
            'god-of-war' => [
                'title' => 'God of War',
                'category' => 'Aksiyon, Macera, Hikaye Odaklı, Üçüncü Şahıs',
                'description' => 'Yunan tanrılarından intikamını alan Kratos, kuzeyin acımasız topraklarında, yepyeni bir yaşam kurmaya çalıştığı bir dünyada kendini ve oğlunu eğittiğiniz, üçüncü şahıs hikaye odaklı aksiyon oyunu.',
                'developer' => 'Santa Monica Studio',
                'publisher' => 'Sony Interactive Entertainment',
                'price' => 329.99,
                'discount_price' => 230.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1593500/header.jpg',
            ],
            'batman-arkham-knight' => [
                'title' => 'Batman: Arkham Knight',
                'category' => 'Aksiyon, Macera, Süper Kahraman, Açık Dünya',
                'description' => 'Arkham serisinin son bölümü olan bu oyunda, Batman\'in en tehlikeli düşmanlarıyla karşı karşıya geldiği ve Gotham\'ı kurtarmak için ölümcül bir mücadeleye girdiği Arkham Knight hikayesini deneyimleyin.',
                'developer' => 'Rocksteady Studios',
                'publisher' => 'Warner Bros. Interactive Entertainment',
                'price' => 149.99,
                'discount_price' => 37.49,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/208650/header.jpg',
            ],
            'fifa-23' => [
                'title' => 'FIFA 23',
                'category' => 'Spor, Futbol, Simülasyon, Rekabetçi, Çok Oyunculu',
                'description' => 'FIFA 23 oyunuyla dünya çapındaki kulüpler, oyuncular ve turnuvalarla gerçekçi futbol deneyimini yaşayın.',
                'developer' => 'EA Vancouver',
                'publisher' => 'Electronic Arts',
                'price' => 699.99,
                'discount_price' => 349.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1811260/header.jpg',
            ],
            'f1-2022' => [
                'title' => 'F1 22',
                'category' => 'Yarış, Spor, Simülasyon, Rekabetçi',
                'description' => 'F1 22 ile 2022 FIA Formula 1 Dünya Şampiyonası'nın resmi videoyunu ile Formula 1'in heyecanını deneyimleyin, kendi takımınızı oluşturun ve hayalinizdeki pilotluğu yaşayın.',
                'developer' => 'Codemasters',
                'publisher' => 'EA Sports',
                'price' => 399.99,
                'discount_price' => 199.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1708600/header.jpg',
            ],
            'civilization-vi' => [
                'title' => 'Civilization VI',
                'category' => 'Strateji, Sıra Tabanlı, 4X, Tarih',
                'description' => 'Sid Meier\'s Civilization VI\'da kendi uygarlığınızı kurun ve zaman içinde geliştirin. Dünya haritasını keşfedin, teknolojilerinizi geliştirin, kültürünüzü zenginleştirin ve diğer büyük liderlerle karşı karşıya gelerek zafer kazanın.',
                'developer' => 'Firaxis Games',
                'publisher' => '2K Games',
                'price' => 250.00,
                'discount_price' => 75.00,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/289070/header.jpg',
            ],
            'crusader-kings-iii' => [
                'title' => 'Crusader Kings III',
                'category' => 'Strateji, Simülasyon, Rol Yapma, Tarih, Orta Çağ',
                'description' => 'Kendi hanedanınızı yöneterek, hükümdarlığınızı sürdürün ve hanedanınızı Orta Çağ\'ın en güçlü ailesi haline getirin. Bu geniş, karakter odaklı strateji oyununda soyunuzu devam ettirin ve mirasınızı inşa edin.',
                'developer' => 'Paradox Development Studio',
                'publisher' => 'Paradox Interactive',
                'price' => 349.99,
                'discount_price' => 174.99,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1158310/header.jpg',
            ],
            'outlast' => [
                'title' => 'Outlast',
                'category' => 'Korku, Hayatta Kalma, Birinci Şahıs, Gerilim',
                'description' => 'Bir gazeteci olarak akıl hastanesindeki gizemleri araştırırken korkunç gerçeklerle karşılaşacağınız yoğun korku dolu bir hayatta kalma mücadelesi. Savaşamazsınız, sadece koşabilir ve saklanabilirsiniz.',
                'developer' => 'Red Barrels',
                'publisher' => 'Red Barrels',
                'price' => 89.99,
                'discount_price' => 22.49,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/238320/header.jpg',
            ],
            'layers-of-fear' => [
                'title' => 'Layers of Fear',
                'category' => 'Korku, Psikolojik, Birinci Şahıs, Bulmaca',
                'description' => 'Viktorya dönemi bir konakta, zihninin sürekli değişen koridorlarında deliliğe sürüklenirken, mükemmel başyapıtını tamamlamaya çalışan bir ressamın gözünden yaşanan psikolojik korku oyunu.',
                'developer' => 'Bloober Team',
                'publisher' => 'Aspyr',
                'price' => 129.99,
                'discount_price' => 32.49,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/391720/header.jpg',
            ],
            'counter-strike-2' => [
                'title' => 'Counter-Strike 2',
                'category' => 'FPS, Aksiyon, Çok Oyunculu, Rekabetçi, Taktiksel',
                'description' => 'Counter-Strike 2, dünyanın en popüler taktiksel FPS oyunudur. Teröristler veya anti-teröristler olarak birbirinize karşı savaştığınız, takım çalışması, strateji ve beceri gerektiren rekabetçi bir oyundur.',
                'developer' => 'Valve',
                'publisher' => 'Valve',
                'price' => 0,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/730/header.jpg',
            ],
            'dota-2' => [
                'title' => 'Dota 2',
                'category' => 'MOBA, Strateji, Çok Oyunculu, Rekabetçi, Takım Odaklı',
                'description' => 'Her gün milyonlarca oyuncu tarafından oynanan dünyanın en popüler MOBA oyunlarından biri. 100\'den fazla kahraman ve sonsuz stratejik olasılık ile her maç benzersiz bir deneyim sunar.',
                'developer' => 'Valve',
                'publisher' => 'Valve',
                'price' => 0,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/570/header.jpg',
            ],
            'apex-legends' => [
                'title' => 'Apex Legends',
                'category' => 'FPS, Battle Royale, Aksiyon, Çok Oyunculu, Takım Odaklı',
                'description' => 'Güçlü yeteneklere sahip eşsiz karakterler, gelişmiş silahlar ve taktiksel takım oyunu sunan ücretsiz bir battle royale-FPS oyunu. Diğer oyuncularla takım oluşturun, eşyaları toplayın ve zafere ulaşmak için son takım olarak hayatta kalmaya çalışın.',
                'developer' => 'Respawn Entertainment',
                'publisher' => 'Electronic Arts',
                'price' => 0,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/1172470/header.jpg',
            ],
            'fortnite' => [
                'title' => 'Fortnite',
                'category' => 'Battle Royale, Aksiyon, Çok Oyunculu, Üçüncü Şahıs, İnşaat',
                'description' => 'Fortnite, benzersiz yapı mekanikleri içeren popüler bir battle royale oyunudur. Silahlar toplayın, yapılar inşa edin ve 100 oyunculu savaşta hayatta kalan son kişi olmak için mücadele edin.',
                'developer' => 'Epic Games',
                'publisher' => 'Epic Games',
                'price' => 0,
                'discount_price' => null,
                'image' => 'https://cdn2.unrealengine.com/social-image-chapter4-s3-3840x2160-d35912cc25ad.jpg',
            ],
            'war-thunder' => [
                'title' => 'War Thunder',
                'category' => 'Simülasyon, Savaş, Aksiyon, Çok Oyunculu, Askeri',
                'description' => 'War Thunder, İkinci Dünya Savaşı ve modern savaş araçlarını içeren çok oyunculu bir askeri oyundur. Tanklar, uçaklar ve gemilerle kara, hava ve deniz savaşlarına katılın.',
                'developer' => 'Gaijin Entertainment',
                'publisher' => 'Gaijin Entertainment',
                'price' => 0,
                'discount_price' => null,
                'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/236390/header.jpg',
            ],
        ];
        
        foreach ($gameUpdates as $slug => $updates) {
            try {
                $game = Game::where('slug', $slug)->first();
                
                if ($game) {
                    // Tüm özellikleri güncelle
                    $game->title = $updates['title'];
                    $game->category = $updates['category'];
                    $game->description = $updates['description'];
                    $game->developer = $updates['developer'];
                    $game->publisher = $updates['publisher'];
                    $game->price = $updates['price'];
                    $game->discount_price = $updates['discount_price'];
                    $game->image = $updates['image'];
                    $game->save();
                    
                    Log::info('Fixed game: ' . $game->title);
                } else {
                    Log::warning('Game not found: ' . $slug);
                }
            } catch (\Exception $e) {
                Log::error('Error fixing game ' . $slug . ': ' . $e->getMessage());
            }
        }
        
        Log::info('FixGameProperties completed successfully');
    }
}


