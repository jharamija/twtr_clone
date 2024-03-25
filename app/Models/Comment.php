<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'parent_comment_id',
        'body',
    ];

    public function user(): BelongsTo {
        return $this->BelongsTo(User::class);
    }

    public function post(): BelongsTo {
        return $this->BelongsTo(Post::class);
    }

    public function comment(): BelongsTo {
        return $this->BelongsTo(Comment::class, 'parent_comment_id');
    }
}
