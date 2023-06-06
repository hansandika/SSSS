<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'slug', 'user_id', 'category_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function getLikesCountAttribute(): int
    {
        return $this->likes->where('type', '1')->count();
    }

    public function getDislikesCountAttribute(): int
    {
        return $this->likes->where('type', '0')->count();
    }

    public function getIsLikedAttribute(): bool
    {
        if (auth()->guest()) {
            return false;
        }

        return $this->likes->where('user_id', auth()->user()->id)->where('type', '1')->count() === 1;
    }

    public function getIsDislikedAttribute(): bool
    {
        if (auth()->guest()) {
            return false;
        }

        return $this->likes->where('user_id', auth()->user()->id)->where('type', '0')->count() === 1;
    }

    public function getCommentsCountAttribute(): int
    {
        return $this->comments->count();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}
