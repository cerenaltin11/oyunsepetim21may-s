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
}
