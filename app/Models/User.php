<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'banner',
        'is_admin',
        'last_login_at',
        'previous_login_at',
        'login_count',
        'consecutive_days',
        'level',
        'xp',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'previous_login_at' => 'datetime',
    ];

    /**
     * Get the reviews written by the user.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    /**
     * The badges that belong to the user.
     */
    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges')
            ->withPivot('awarded_at', 'is_displayed')
            ->withTimestamps();
    }
    
    /**
     * Check if the user has earned a specific badge.
     */
    public function hasBadge($badgeId)
    {
        return $this->badges()->where('badge_id', $badgeId)->exists();
    }
    
    /**
     * Check if the user has the ultimate login badge
     */
    public function hasUltimateBadge()
    {
        $ultimateBadge = Badge::where('name', 'ultimate_login')->first();
        if (!$ultimateBadge) {
            return false;
        }
        return $this->hasBadge($ultimateBadge->id);
    }
    
    /**
     * Check if the user has the admin badge
     */
    public function hasAdminBadge()
    {
        $adminBadge = Badge::where('name', 'admin_badge')->first();
        if (!$adminBadge) {
            return false;
        }
        return $this->hasBadge($adminBadge->id);
    }
    
    /**
     * Update the user's login information.
     */
    public function trackLogin()
    {
        $now = now();
        $lastLogin = $this->last_login_at;
        
        // Update previous login time
        $this->previous_login_at = $lastLogin;
        
        // Update last login time
        $this->last_login_at = $now;
        
        // Increment login count
        $this->login_count++;
        
        // Check consecutive days
        if ($lastLogin && $now->diffInDays($lastLogin) == 1) {
            // If user logged in yesterday
            $this->consecutive_days++;
        } elseif ($lastLogin && $now->diffInDays($lastLogin) > 1) {
            // If user didn't log in yesterday, reset streak
            $this->consecutive_days = 1;
        } elseif (!$lastLogin) {
            // First login
            $this->consecutive_days = 1;
        }
        
        $this->save();
        
        return $this;
    }

    // Steam mantığına benzer level hesaplama
    public function getLevelAttribute()
    {
        // Her level için gereken XP: 100 * level
        // 0-99 XP: Level 1, 100-199 XP: Level 2, 200-299 XP: Level 3, ...
        return floor($this->xp / 100) + 1;
    }

    public function library()
    {
        return $this->belongsToMany(Game::class, 'user_games', 'user_id', 'game_id')->withTimestamps()->withPivot('purchased_at');
    }

    /**
     * Get all friends of the user (accepted friendships)
     */
    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->wherePivot('status', 'accepted')
            ->withTimestamps();
    }

    /**
     * Get pending friend requests sent by the user
     */
    public function pendingSentFriendRequests()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->wherePivot('status', 'pending')
            ->withTimestamps();
    }

    /**
     * Get pending friend requests received by the user
     */
    public function pendingReceivedFriendRequests()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')
            ->wherePivot('status', 'pending')
            ->withTimestamps();
    }

    /**
     * Get blocked users by the user
     */
    public function blockedUsers()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->wherePivot('status', 'blocked')
            ->withTimestamps();
    }

    /**
     * Get the games owned by the user.
     */
    public function games()
    {
        return $this->belongsToMany(Game::class, 'user_games', 'user_id', 'game_id')
            ->withPivot('purchased_at', 'play_time')
            ->withTimestamps();
    }

    /**
     * Get the user's game ownership records.
     */
    public function userGames()
    {
        return $this->hasMany(UserGame::class);
    }

    /**
     * Check if the user owns a specific game.
     */
    public function ownsGame($gameId)
    {
        return $this->userGames()->where('game_id', $gameId)->exists();
    }

    // Oyun satın alma rozetlerini kontrol et
    public function checkPurchaseBadges()
    {
        $purchaseCount = $this->games()->count();
        $this->awardBadgeIfEligible('first_purchase', $purchaseCount, 1);
        $this->awardBadgeIfEligible('five_purchases', $purchaseCount, 5);
        $this->awardBadgeIfEligible('ten_purchases', $purchaseCount, 10);
        $this->awardBadgeIfEligible('ten_games_in_library', $purchaseCount, 10);
    }

    // İnceleme rozetlerini kontrol et
    public function checkReviewBadges()
    {
        $reviewCount = $this->reviews()->count();
        $this->awardBadgeIfEligible('first_review', $reviewCount, 1);
        $this->awardBadgeIfEligible('five_reviews', $reviewCount, 5);
    }

    // Genel amaçlı rozet verme fonksiyonu
    private function awardBadgeIfEligible($badgeName, $userCount, $requiredCount)
    {
        $badge = \App\Models\Badge::where('name', $badgeName)->first();
        if ($badge && $userCount >= $requiredCount && !$this->hasBadge($badge->id)) {
            $this->badges()->attach($badge->id, [
                'awarded_at' => now(),
                'is_displayed' => true
            ]);
        }
    }
}
