<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'body',
        'likes',
        'comments',
        'retweets',
    ];

    public function comments(): HasMany {
        return $this->HasMany(Comment::class);
    }

    public function user(): BelongsTo {
        return $this->BelongsTo(User::class);
    }
}
