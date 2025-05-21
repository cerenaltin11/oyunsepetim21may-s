<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Support\Facades\Log;

class GameDescriptionUpdater extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::info('Starting GameDescriptionUpdater');
        Log::info('Current game count: ' . Game::count());
        
        $descriptions = [
            'cyberpunk-2077' => 'Cyberpunk 2077, CD Projekt tarafından geliştirilen ve yayınlanan 2020 aksiyon rol yapma video oyunudur. Hikaye, Cyberpunk evreninde açık bir dünya olan Night City\'de geçmektedir.',
            
            'resident-evil-village' => 'Resident Evil Village, Capcom tarafından geliştirilen ve yayınlanan bir hayatta kalma korku video oyunudur. Resident Evil serisinin dokuzuncu ana oyunu ve Resident Evil 7: Biohazard\'ın devamıdır.',
            
            'age-of-empires-iv' => 'Age of Empires IV, Relic Entertainment ve World\'s Edge tarafından geliştirilen ve Xbox Game Studios tarafından yayınlanan gerçek zamanlı strateji video oyunudur.',
            
            'call-of-duty-modern-warfare-ii' => 'Call of Duty: Modern Warfare II, Infinity Ward tarafından geliştirilen ve Activision tarafından yayınlanan 2022 birinci şahıs nişancı video oyunudur. Call of Duty serisinin on dokuzuncu oyunudur.',
            
            'elden-ring' => 'Elden Ring, FromSoftware tarafından geliştirilen ve Bandai Namco Entertainment tarafından yayınlanan bir aksiyon rol yapma oyunudur. Oyun, Elden Ring\'in parçalanmasından sonra Lands Between\'de geçmektedir.',
            
            'the-witcher-3' => 'The Witcher 3: Wild Hunt, Polonyalı geliştirici CD Projekt Red tarafından geliştirilen ve yayınlanan 2015 aksiyon rol yapma oyunudur.',
            
            'god-of-war' => 'God of War, Sony\'nin Santa Monica Studio\'sunda David Jaffe tarafından yaratılan bir aksiyon-macera oyun serisidir.',
            
            'batman-arkham-knight' => 'Batman: Arkham Knight, Rocksteady Studios tarafından geliştirilen 2015 aksiyon-macera oyunudur.',
            
            'fifa-23' => 'FIFA 23, Electronic Arts tarafından yayınlanan bir futbol simülasyon video oyunudur.',
            
            'f1-2022' => 'F1 2022 ile 2022 FIA Formula One Dünya Şampiyonası\'nın resmi video oyunu ile Formula 1\'in heyecanını yaşayın.',
            
            'civilization-vi' => 'Civilization VI, bir oyuncunun Taş Devri\'nden Bilgi Çağı\'na kadar bir medeniyetin kontrolünü ele aldığı sıra tabanlı bir strateji oyunudur.',
            
            'crusader-kings-iii' => 'Crusader Kings III, Paradox Development Studio tarafından geliştirilen, Orta Çağ\'da geçen bir büyük strateji oyunu ve RPG\'dir.',
            
            'outlast' => 'Outlast, Red Barrels tarafından geliştirilen ve yayınlanan birinci şahıs hayatta kalma korku video oyunudur.',
            
            'layers-of-fear' => 'Layers of Fear, hikaye ve keşif odaklı birinci şahıs psikolojik korku oyunudur.',
            
            'counter-strike-2' => 'Counter-Strike 2, Valve tarafından geliştirilen ücretsiz çok oyunculu taktiksel birinci şahıs nişancı oyunudur.',
            
            'dota-2' => 'Dota 2, Valve tarafından geliştirilen ve yayınlanan çok oyunculu çevrimiçi savaş arenası (MOBA) oyunudur.',
            
            'apex-legends' => 'Apex Legends, Respawn Entertainment tarafından geliştirilen ve Electronic Arts tarafından yayınlanan ücretsiz bir battle royale-kahraman nişancı oyunudur.',
            
            'fortnite' => 'Fortnite, her türlü oyun oyuncusu için çeşitli oyun modlarına sahip ücretsiz bir Battle Royale oyunudur.',
            
            'war-thunder' => 'War Thunder, Gaijin Entertainment tarafından geliştirilen ücretsiz bir araç savaşı çok oyunculu video oyunudur. Oyun, İspanyol İç Savaşı\'ndan Soğuk Savaş dönemine kadar olan araçlarla hava, kara ve denizde birleşik silahlar savaşları etrafında kurulmuştur.'
        ];
        
        foreach ($descriptions as $slug => $turkishDescription) {
            try {
                $game = Game::where('slug', $slug)->first();
                
                if ($game) {
                    $game->description = $turkishDescription;
                    $game->save();
                    Log::info('Updated description for game: ' . $game->title);
                } else {
                    Log::info('Game not found: ' . $slug);
                }
            } catch (\Exception $e) {
                Log::error('Error updating description for game ' . $slug . ': ' . $e->getMessage());
            }
        }
        
        Log::info('GameDescriptionUpdater completed successfully');
    }
} 