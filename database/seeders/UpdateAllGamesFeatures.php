<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Support\Facades\Log;

class UpdateAllGamesFeatures extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::info('Starting UpdateAllGamesFeatures');
        
        // Tüm oyunları al
        $games = Game::all();
        
        foreach ($games as $game) {
            try {
                // Kategori alanını Türkçeleştir
                $category = $this->translateCategory($game->category);
                
                // Oyun özelliklerini güncelle
                $game->category = $category;
                $game->save();
                
                Log::info('Updated game: ' . $game->title . ' - Category: ' . $category);
            } catch (\Exception $e) {
                Log::error('Error updating features for game ' . $game->title . ': ' . $e->getMessage());
            }
        }
        
        // Diğer özel oyun güncellemeleri
        $this->updateFortnite();
        $this->updateWarThunder();
        
        Log::info('UpdateAllGamesFeatures completed successfully');
    }
    
    /**
     * Kategori alanını Türkçeleştir
     * 
     * @param string $category
     * @return string
     */
    private function translateCategory($category)
    {
        // İngilizce-Türkçe çeviri tablosu
        $translations = [
            'Action' => 'Aksiyon',
            'RPG' => 'Rol Yapma',
            'Sport' => 'Spor',
            'Racing' => 'Yarış',
            'Strategy' => 'Strateji',
            'Horror' => 'Korku',
            'Adventure' => 'Macera',
            'Open World' => 'Açık Dünya',
            'FPS' => 'FPS',
            'Simulation' => 'Simülasyon',
            'Battle Royale' => 'Battle Royale',
            'Multiplayer' => 'Çok Oyunculu',
            'War' => 'Savaş',
            'Free' => 'Ücretsiz',
            'Turn-Based' => 'Sıra Tabanlı',
            'Story Rich' => 'Hikaye Odaklı',
            'Survival' => 'Hayatta Kalma',
            'First-Person' => 'Birinci Şahıs',
            'MOBA' => 'MOBA',
            'Fantasy' => 'Fantastik',
            'Football' => 'Futbol',
            'History' => 'Tarih',
            'Psychological' => 'Psikolojik',
            'Competitive' => 'Rekabetçi',
            'Superhero' => 'Süper Kahraman',
        ];
        
        // Zaten Türkçe ise dokunma
        if (strpos($category, 'Aksiyon') !== false || 
            strpos($category, 'Rol Yapma') !== false || 
            strpos($category, 'Spor') !== false) {
            return $category;
        }
        
        // Her bir kategoriyi çevir
        foreach ($translations as $english => $turkish) {
            $category = str_ireplace($english, $turkish, $category);
        }
        
        return $category;
    }
    
    /**
     * Fortnite oyununu güncelle
     */
    private function updateFortnite()
    {
        try {
            $game = Game::where('slug', 'fortnite')->first();
            
            if ($game) {
                $game->category = 'Battle Royale, Aksiyon, Çok Oyunculu, Üçüncü Şahıs';
                $game->price = 0;
                $game->discount_price = null;
                $game->save();
                
                Log::info('Updated Fortnite manually');
            } else {
                Log::warning('Fortnite not found');
            }
        } catch (\Exception $e) {
            Log::error('Error updating Fortnite: ' . $e->getMessage());
        }
    }
    
    /**
     * War Thunder oyununu güncelle
     */
    private function updateWarThunder()
    {
        try {
            $game = Game::where('slug', 'war-thunder')->first();
            
            if ($game) {
                $game->category = 'Simülasyon, Savaş, Aksiyon, Çok Oyunculu, Ücretsiz';
                $game->price = 0;
                $game->discount_price = null;
                $game->save();
                
                Log::info('Updated War Thunder manually');
            } else {
                Log::warning('War Thunder not found');
            }
        } catch (\Exception $e) {
            Log::error('Error updating War Thunder: ' . $e->getMessage());
        }
    }
} 