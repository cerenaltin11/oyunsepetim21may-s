<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\UserGame;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class LibraryController extends Controller
{
    /**
     * Display the user's library (purchased games)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Redirect to login if not authenticated
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Kütüphanenize erişmek için giriş yapmalısınız.');
        }
        
        // HACK: Kütüphane problemiyle ilgili workaround
        // Oyunun detay sayfasında görünüyor ancak kütüphane sayfasında görünmüyor, eldeki oyunları kontrol edelim
        // Kullanıcının user_games kaydını kontrol et
        $userId = Auth::id();
        $gameIds = [];
        
        // 1. Direkt veritabanından kontrol
        $userGamesDb = DB::table('user_games')->where('user_id', $userId)->pluck('game_id')->toArray();
        if (!empty($userGamesDb)) {
            $gameIds = array_merge($gameIds, $userGamesDb);
        }
        
        // 2. Detay sayfasından erişilebilen oyunları kontrol et (URL parametrelerinden oyun ID'yi çek)
        $routeName = request()->route()->getName();
        if ($routeName && $routeName === 'library.game' && request()->route('gameId')) {
            $gameIds[] = request()->route('gameId');
        }
        
        // 3. Eğer gameIds varsa, bunları kullanıcının kütüphanesine ekle
        if (!empty($gameIds)) {
            foreach ($gameIds as $gameId) {
                // Eğer zaten eklenmemişse, ekle
                $exists = DB::table('user_games')
                    ->where('user_id', $userId)
                    ->where('game_id', $gameId)
                    ->exists();
                
                if (!$exists) {
                    DB::table('user_games')->insert([
                        'user_id' => $userId,
                        'game_id' => $gameId,
                        'purchased_at' => now(),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        try {
            // Get user's games from database
            $userGames = UserGame::where('user_id', $userId)->with('game')->get();
            
            $libraryItems = $userGames->map(function($userGame) {
                return $userGame->game;
            })->filter(); // Filter out any null values
            
            // Get free games
            $freeGames = Game::where('price', 0)->whereDoesntHave('users', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })->get();
            
            return view('library', [
                'libraryItems' => $libraryItems,
                'freeGames' => $freeGames,
                'totalCount' => $libraryItems->count()
            ]);
        } catch (\Exception $e) {
            \Log::error('Library load error: ' . $e->getMessage());
            return redirect()->route('home')
                ->with('error', 'Kütüphane yüklenirken bir hata oluştu. Lütfen tekrar deneyin.');
        }
    }
    
    /**
     * Add a game to the user's library (called after successful purchase)
     *
     * @param  array  $gameIds
     * @return void
     */
    public function addGames($gameIds)
    {
        if (!Auth::check()) {
            return;
        }
        
        $userId = Auth::id();
        $now = now();
        
        foreach ($gameIds as $gameId) {
            // Check if the user already owns this game
            $exists = UserGame::where('user_id', $userId)
                ->where('game_id', $gameId)
                ->exists();
                
            if (!$exists) {
                UserGame::create([
                    'user_id' => $userId,
                    'game_id' => $gameId,
                    'purchased_at' => $now
                ]);
            }
        }
    }
    
    /**
     * Directly add a free game to the user's library
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addDirect(Request $request)
    {
        // Redirect to login if not authenticated
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Oyun kütüphanenize eklemek için giriş yapmalısınız.');
        }
        
        $request->validate([
            'game_id' => 'required|exists:games,id'
        ]);
        
        $gameId = $request->game_id;
        $game = Game::find($gameId);
        
        if (!$game) {
            return redirect()->back()->with('error', 'Oyun bulunamadı');
        }
        
        // Verify the game is free
        if ($game->price != 0 && ($game->discount_price === null || $game->discount_price != 0)) {
            return redirect()->back()->with('error', 'Yalnızca ücretsiz oyunlar doğrudan kütüphaneye eklenebilir');
        }
        
        // Check if the user already owns this game
        $exists = UserGame::where('user_id', Auth::id())
            ->where('game_id', $gameId)
            ->exists();
            
        if ($exists) {
            return redirect()->back()->with('warning', 'Bu oyun zaten kütüphanenizde bulunuyor.');
        }
        
        try {
            // Add game to library
            UserGame::create([
                'user_id' => Auth::id(),
                'game_id' => $gameId,
                'purchased_at' => now()
            ]);
            
            return redirect()->route('library')
                ->with('success', $game->title . ' kütüphanenize eklendi! Hemen oynamaya başlayabilirsiniz.');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Game add error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Oyun eklenirken bir hata oluştu. Lütfen tekrar deneyin.');
        }
    }
    
    /**
     * Download a game from the library
     *
     * @param  int  $gameId
     * @return \Illuminate\Http\Response
     */
    public function download($gameId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Oyun indirmek için giriş yapmalısınız.');
        }
        
        // Check if the user owns this game
        $hasGame = UserGame::where('user_id', Auth::id())
            ->where('game_id', $gameId)
            ->exists();
            
        if (!$hasGame) {
            return redirect()->back()
                ->with('error', 'Bu oyun kütüphanenizde bulunmuyor.');
        }
        
        $game = Game::find($gameId);
        if (!$game) {
            return redirect()->back()
                ->with('error', 'Oyun bulunamadı.');
        }
        
        // Oyun adını içeren bir text dosyası oluştur
        $fileName = $game->slug . '_info.txt';
        $content = "OyunSepetim - Oyun Bilgileri\n\n";
        $content .= "Oyun: " . $game->title . "\n";
        $content .= "Kategori: " . $game->category . "\n";
        $content .= "Geliştirici: " . $game->developer . "\n";
        $content .= "Yayıncı: " . $game->publisher . "\n";
        $content .= "Çıkış Tarihi: " . ($game->release_date ? date('d.m.Y', strtotime($game->release_date)) : 'Belirtilmemiş') . "\n\n";
        $content .= "Bu dosya, oyunu indirdiğinizi simüle etmek için oluşturulmuştur.\n";
        $content .= "Gerçek bir oyun kurulum dosyası değildir.\n\n";
        $content .= "Oyun indirme ve kurulum süreciniz başarıyla tamamlandı.\n";
        $content .= "İyi oyunlar dileriz!";
        
        // Dosyayı indir
        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }
    
    /**
     * Display the detail view for a game in the user's library
     *
     * @param  int  $gameId
     * @return \Illuminate\Http\Response
     */
    public function gameDetail($gameId)
    {
        // Redirect to login if not authenticated
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Kütüphanenize erişmek için giriş yapmalısınız.');
        }
        
        $userId = Auth::id();
        
        // Oyunun varlığını kontrol et
        $game = Game::find($gameId);
        if (!$game) {
            return redirect()->route('library')
                ->with('error', 'Oyun bulunamadı.');
        }
        
        // Oyunu kütüphaneye ekle veya daha önce eklenmiş mi kontrol et
        $userGame = UserGame::where('user_id', $userId)
            ->where('game_id', $gameId)
            ->first();
            
        if (!$userGame) {
            // Oyun daha önce eklenmemişse ekle
            UserGame::create([
                'user_id' => $userId,
                'game_id' => $gameId,
                'purchased_at' => now(),
                'play_time' => 0
            ]);
            
            // Log ekleyelim
            \Log::info("Oyun #{$gameId} kullanıcı #{$userId} için kütüphaneye eklendi");
        }
        
        return view('games.game_detail', [
            'game' => $game,
            'hasGame' => true
        ]);
    }
} 