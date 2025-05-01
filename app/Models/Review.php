<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'game_id',
        'rating',
        'comment',
        'is_approved',
        'helpful_count',
    ];
    
    /**
     * Get the user who wrote the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the game that was reviewed.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
