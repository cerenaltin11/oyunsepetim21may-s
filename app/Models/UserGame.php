<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGame extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'game_id',
        'purchased_at',
        'play_time'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'purchased_at' => 'datetime',
    ];

    /**
     * Get the user that owns the game.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the game owned by the user.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
} 