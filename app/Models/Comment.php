<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'user_id', 'post_id', 'parent_id'];
    protected $with = ['user', 'likes', 'replies'];

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getAuthorAttribute(): string
    {
        $post = $this->post;
        $postAuthor = $post->user;
        return ($this->user_id === $postAuthor->id ? 'Owner' : $this->user->user_name);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class)->with('user');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function likedBy(User $user): bool
    {
        return $this->likes->where('user_id', $user->id)->where('type', 1)->count() > 0;
    }

    public function dislikedBy(User $user): bool
    {
        return $this->likes->where('user_id', $user->id)->where('type', 0)->count() > 0;
    }

    public function getLikesCountAttribute(): int
    {
        return $this->likes->where('type', '1')->count();
    }

    public function getDislikesCountAttribute(): int
    {
        return $this->likes->where('type', '0')->count();
    }
}
