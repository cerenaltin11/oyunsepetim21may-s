<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'price',
        'discount_price',
        'image',
        'release_date',
        'developer',
        'publisher',
    ];
    
    /**
     * Get the reviews for the game.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    /**
     * Get the average rating for the game.
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->where('is_approved', true)->avg('rating') ?? 0;
    }
    
    /**
     * Get the review count for the game.
     */
    public function getReviewCountAttribute()
    {
        return $this->reviews()->where('is_approved', true)->count();
    }
} 