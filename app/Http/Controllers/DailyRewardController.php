<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Badge;
use App\Models\User;
use Carbon\Carbon;

class DailyRewardController extends Controller
{
    /**
     * Check if the user has a daily reward available
     */
    public function check()
    {
        if (!Auth::check()) {
            return response()->json([
                'reward_available' => false,
                'error' => 'User not authenticated'
            ]);
        }
        
        $user = Auth::user();
        
        // Debug bilgileri ekleyelim
        $now = now();
        $lastLogin = $user->last_login_at;
        $minutesSinceLastLogin = $lastLogin ? $now->diffInMinutes($lastLogin) : null;
        $lastLoginToday = $lastLogin ? $lastLogin->isToday() : false;
        
        // Check if user already claimed a reward today
        if ($lastLogin && $lastLogin->isToday()) {
            // Kullanıcı bugün zaten giriş yapmışsa, son giriş saatini ve şimdiyi karşılaştır
            // Eğer son 5 dakika içinde giriş yapmışsa, ödülü göster (yeni giriş yapmış kabul edilir)
            $minutesSinceLastLogin = now()->diffInMinutes($lastLogin);
            
            if ($minutesSinceLastLogin <= 5) {
                return response()->json([
                    'reward_available' => true,
                    'consecutive_days' => $user->consecutive_days,
                    'login_count' => $user->login_count,
                    'debug' => [
                        'reason' => 'within_5_minutes',
                        'last_login' => $lastLogin,
                        'minutes_since' => $minutesSinceLastLogin
                    ]
                ]);
            }
            
            return response()->json([
                'reward_available' => false,
                'debug' => [
                    'reason' => 'already_claimed_today',
                    'last_login' => $lastLogin, 
                    'last_login_today' => $lastLoginToday,
                    'minutes_since' => $minutesSinceLastLogin
                ]
            ]);
        }
        
        return response()->json([
            'reward_available' => true,
            'consecutive_days' => $user->consecutive_days,
            'login_count' => $user->login_count,
            'debug' => [
                'reason' => 'new_day_login',
                'last_login' => $lastLogin,
                'last_login_today' => $lastLoginToday,
                'minutes_since' => $minutesSinceLastLogin
            ]
        ]);
    }
    
    /**
     * Claim the daily reward and check for badges
     */
    public function claim()
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false, 
                'message' => 'User not authenticated'
            ], 401);
        }
        
        $user = Auth::user();
        
        // Günlük ödül için son login bilgisini güncelle
        $now = now();
        $lastLogin = $user->last_login_at;
        
        // Update previous login time
        $user->previous_login_at = $lastLogin;
        
        // Update last login time
        $user->last_login_at = $now;
        
        // Increment login count - Eğer login route'da arttırılmadıysa
        if (!$lastLogin || !$lastLogin->isToday()) {
            $user->login_count++;
            
            // Check consecutive days
            if ($lastLogin && $now->diffInDays($lastLogin) == 1) {
                // If user logged in yesterday
                $user->consecutive_days++;
            } elseif ($lastLogin && $now->diffInDays($lastLogin) > 1) {
                // If user didn't log in yesterday, reset streak
                $user->consecutive_days = 1;
            } elseif (!$lastLogin) {
                // First login
                $user->consecutive_days = 1;
            }
        }
        
        $user->save();
        
        // Check for login badges
        $this->checkForLoginBadges($user);
        
        // Always check for admin badge
        if ($user->is_admin) {
            $adminBadge = Badge::where('name', 'admin_badge')->first();
            if ($adminBadge && !$user->hasBadge($adminBadge->id)) {
                $user->badges()->attach($adminBadge->id, [
                    'awarded_at' => now()
                ]);
            }
        }
        
        // Retrieve newly awarded badges with detailed information
        $recentBadges = $user->badges()
            ->wherePivot('awarded_at', '>=', now()->subMinutes(5))
            ->get()
            ->map(function($badge) {
                return [
                    'id' => $badge->id,
                    'name' => $badge->name,
                    'description' => $badge->description,
                    'icon' => $badge->icon,
                    'type' => $badge->type,
                    'awarded_at' => $badge->pivot->awarded_at
                ];
            });
        
        return response()->json([
            'success' => true,
            'consecutive_days' => $user->consecutive_days,
            'login_count' => $user->login_count,
            'new_badges' => $recentBadges
        ]);
    }
    
    /**
     * Check if user should be awarded any login-related badges
     */
    private function checkForLoginBadges(User $user)
    {
        // Award first login badge
        if ($user->login_count === 1) {
            $this->awardBadge($user, 'first_login');
        }
        
        // Award consecutive login badges
        if ($user->consecutive_days === 3) {
            $this->awardBadge($user, 'three_day_streak');
        } elseif ($user->consecutive_days === 7) {
            $this->awardBadge($user, 'week_streak');
        } elseif ($user->consecutive_days === 30) {
            $this->awardBadge($user, 'month_streak');
        }
        
        // Award login count badges
        if ($user->login_count === 10) {
            $this->awardBadge($user, 'ten_logins');
        } elseif ($user->login_count === 50) {
            $this->awardBadge($user, 'fifty_logins');
        } elseif ($user->login_count === 100) {
            $this->awardBadge($user, 'hundred_logins');
        } elseif ($user->login_count === 365) {
            $this->awardBadge($user, 'ultimate_login');
        }
    }
    
    /**
     * Award a badge to a user
     */
    private function awardBadge(User $user, string $badgeCode)
    {
        $badge = Badge::where('name', $badgeCode)->first();
        
        if ($badge && !$user->hasBadge($badge->id)) {
            $user->badges()->attach($badge->id, [
                'awarded_at' => now()
            ]);
        }
    }
} 