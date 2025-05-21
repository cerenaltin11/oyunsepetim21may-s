<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $badges = [
            [
                'name' => 'first_login',
                'description' => 'İlk Giriş Rozeti',
                'icon' => 'fa-sign-in-alt',
                'type' => 'login',
                'required_count' => 1,
            ],
            [
                'name' => 'three_day_streak',
                'description' => '3 Gün Seri Giriş Rozeti',
                'icon' => 'fa-calendar-check',
                'type' => 'login',
                'required_count' => 3,
            ],
            [
                'name' => 'week_streak',
                'description' => '1 Hafta Seri Giriş Rozeti',
                'icon' => 'fa-calendar-week',
                'type' => 'login',
                'required_count' => 7,
            ],
            [
                'name' => 'month_streak',
                'description' => '1 Ay Seri Giriş Rozeti',
                'icon' => 'fa-calendar-alt',
                'type' => 'login',
                'required_count' => 30,
            ],
            [
                'name' => 'ten_logins',
                'description' => '10 Giriş Rozeti',
                'icon' => 'fa-award',
                'type' => 'login',
                'required_count' => 10,
            ],
            [
                'name' => 'fifty_logins',
                'description' => '50 Giriş Rozeti',
                'icon' => 'fa-medal',
                'type' => 'login',
                'required_count' => 50,
            ],
            [
                'name' => 'hundred_logins',
                'description' => '100 Giriş Rozeti',
                'icon' => 'fa-trophy',
                'type' => 'login',
                'required_count' => 100,
            ],
            [
                'name' => 'ultimate_login',
                'description' => 'Nihai Giriş Rozeti',
                'icon' => 'fa-crown',
                'type' => 'login',
                'required_count' => 365,
            ],
            [
                'name' => 'first_purchase',
                'description' => 'İlk Satın Alma Rozeti',
                'icon' => 'fa-shopping-cart',
                'type' => 'purchase',
                'required_count' => 1,
            ],
            [
                'name' => 'experienced_user',
                'description' => 'Deneyimli Kullanıcı Rozeti',
                'icon' => 'fa-user-graduate',
                'type' => 'achievement',
                'required_count' => 1,
            ],
            [
                'name' => 'admin_badge',
                'description' => 'Yönetici Rozeti',
                'icon' => 'fa-shield-alt',
                'type' => 'achievement',
                'required_count' => 1,
            ],
            [
                'name' => 'five_purchases',
                'description' => '5 Oyun Satın Alma Rozeti',
                'icon' => 'fa-shopping-basket',
                'type' => 'purchase',
                'required_count' => 5,
            ],
            [
                'name' => 'ten_purchases',
                'description' => '10 Oyun Satın Alma Rozeti',
                'icon' => 'fa-store',
                'type' => 'purchase',
                'required_count' => 10,
            ],
            [
                'name' => 'first_review',
                'description' => 'İlk İnceleme Rozeti',
                'icon' => 'fa-pen',
                'type' => 'review',
                'required_count' => 1,
            ],
            [
                'name' => 'five_reviews',
                'description' => '5 İnceleme Rozeti',
                'icon' => 'fa-pencil-alt',
                'type' => 'review',
                'required_count' => 5,
            ],
            [
                'name' => 'ten_games_in_library',
                'description' => 'Kütüphanede 10 Oyun Rozeti',
                'icon' => 'fa-gamepad',
                'type' => 'library',
                'required_count' => 10,
            ],
        ];

        foreach ($badges as $badge) {
            Badge::updateOrCreate(
                ['name' => $badge['name']],
                [
                    'description' => $badge['description'],
                    'icon' => $badge['icon'],
                    'type' => $badge['type'],
                    'required_count' => $badge['required_count']
                ]
            );
        }
    }
} 