<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'content',
        'parent_id', // for nested comments
        'is_edited',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(CommunityPost::class, 'post_id');
    }

    public function parent()
    {
        return $this->belongsTo(CommunityComment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(CommunityComment::class, 'parent_id');
    }

    public function likes()
    {
        return $this->hasMany(CommunityLike::class, 'comment_id');
    }
} 