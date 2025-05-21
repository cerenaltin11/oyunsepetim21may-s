<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Support\Facades\Log;

class TurkishGameDescriptions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::info('Starting TurkishGameDescriptions');
        Log::info('Current game count: ' . Game::count());
        
        $games = Game::all();
        foreach ($games as $game) {
            try {
                // Oyun adına göre Türkçe açıklamayı belirle
                $turkishDescription = $this->getTurkishDescription($game->title);
                
                $game->description = $turkishDescription;
                $game->save();
                
                Log::info('Updated description for game: ' . $game->title);
            } catch (\Exception $e) {
                Log::error('Error updating description for game ' . $game->title . ': ' . $e->getMessage());
            }
        }
        
        Log::info('TurkishGameDescriptions completed successfully');
    }
    
    /**
     * Oyun adına göre Türkçe açıklamayı döndürür
     *
     * @param string $gameTitle
     * @return string
     */
    private function getTurkishDescription($gameTitle)
    {
        $descriptions = [
            'Cyberpunk 2077' => 'Cyberpunk 2077, CD Projekt tarafından geliştirilen ve yayınlanan 2020 aksiyon rol yapma video oyunudur. Hikaye, Cyberpunk evreninde açık bir dünya olan Night City\'de geçmektedir.',
            
            'Resident Evil Village' => 'Resident Evil Village, Capcom tarafından geliştirilen ve yayınlanan bir hayatta kalma korku video oyunudur. Resident Evil serisinin dokuzuncu ana oyunu ve Resident Evil 7: Biohazard\'ın devamıdır.',
            
            'Age of Empires IV' => 'Age of Empires IV, Relic Entertainment ve World\'s Edge tarafından geliştirilen ve Xbox Game Studios tarafından yayınlanan gerçek zamanlı strateji video oyunudur.',
            
            'Call of Duty: Modern Warfare II' => 'Call of Duty: Modern Warfare II, Infinity Ward tarafından geliştirilen ve Activision tarafından yayınlanan 2022 birinci şahıs nişancı video oyunudur. Call of Duty serisinin on dokuzuncu oyunudur.',
            
            'Elden Ring' => 'Elden Ring, FromSoftware tarafından geliştirilen ve Bandai Namco Entertainment tarafından yayınlanan bir aksiyon rol yapma oyunudur. Oyun, Elden Ring\'in parçalanmasından sonra Lands Between\'de geçmektedir.',
            
            'The Witcher 3: Wild Hunt' => 'The Witcher 3: Wild Hunt, Polonyalı geliştirici CD Projekt Red tarafından geliştirilen ve yayınlanan 2015 aksiyon rol yapma oyunudur.',
            
            'God of War' => 'God of War, Sony\'nin Santa Monica Studio\'sunda David Jaffe tarafından yaratılan bir aksiyon-macera oyun serisidir.',
            
            'Batman: Arkham Knight' => 'Batman: Arkham Knight, Rocksteady Studios tarafından geliştirilen 2015 aksiyon-macera oyunudur.',
            
            'FIFA 23' => 'FIFA 23, Electronic Arts tarafından yayınlanan bir futbol simülasyon video oyunudur.',
            
            'F1 2022' => 'F1 2022 ile 2022 FIA Formula One Dünya Şampiyonası\'nın resmi video oyunu ile Formula 1\'in heyecanını yaşayın.',
            
            'Civilization VI' => 'Civilization VI, bir oyuncunun Taş Devri\'nden Bilgi Çağı\'na kadar bir medeniyetin kontrolünü ele aldığı sıra tabanlı bir strateji oyunudur.',
            
            'Crusader Kings III' => 'Crusader Kings III, Paradox Development Studio tarafından geliştirilen, Orta Çağ\'da geçen bir büyük strateji oyunu ve RPG\'dir.',
            
            'Outlast' => 'Outlast, Red Barrels tarafından geliştirilen ve yayınlanan birinci şahıs hayatta kalma korku video oyunudur.',
            
            'Layers of Fear' => 'Layers of Fear, hikaye ve keşif odaklı birinci şahıs psikolojik korku oyunudur.',
            
            'Counter-Strike 2' => 'Counter-Strike 2, Valve tarafından geliştirilen ücretsiz çok oyunculu taktiksel birinci şahıs nişancı oyunudur.',
            
            'Dota 2' => 'Dota 2, Valve tarafından geliştirilen ve yayınlanan çok oyunculu çevrimiçi savaş arenası (MOBA) oyunudur.',
            
            'Apex Legends' => 'Apex Legends, Respawn Entertainment tarafından geliştirilen ve Electronic Arts tarafından yayınlanan ücretsiz bir battle royale-kahraman nişancı oyunudur.',
            
            'Fortnite' => 'Fortnite, her türlü oyun oyuncusu için çeşitli oyun modlarına sahip ücretsiz bir Battle Royale oyunudur.',
            
            'War Thunder' => 'War Thunder, Gaijin Entertainment tarafından geliştirilen ücretsiz bir araç savaşı çok oyunculu video oyunudur. Oyun, İspanyol İç Savaşı\'ndan Soğuk Savaş dönemine kadar olan araçlarla hava, kara ve denizde birleşik silahlar savaşları etrafında kurulmuştur.'
        ];
        
        // Eğer oyun adı listedeyse, o açıklamayı döndür
        if (isset($descriptions[$gameTitle])) {
            return $descriptions[$gameTitle];
        }
        
        // Eğer oyun adı listede değilse, varsayılan bir açıklamayı döndür
        return 'Bu oyun, çeşitli özellikler ve heyecan verici oyun mekanikleri sunan kaliteli bir video oyunudur. Ayrıntılı grafikler, sürükleyici hikaye ve yenilikçi oynanış ile oyunculara eşsiz bir deneyim sunmaktadır.';
    }
} 