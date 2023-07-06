<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'biography',
        'avatar',
        'glc_verified',
        'date_of_birth',
        'role',
        'provider',
        'provider_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_of_birth' => 'date',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getLatestCommentAttribute()
    {
        return $this->comments()->latest()->first();
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function getGenderAttribute(string $gender): string
    {
        return ucfirst($gender);
    }

    public function getUserNameAttribute()
    {
        return $this->name ? ucfirst($this->name) : 'Anonymous';
    }

    public function getFirstNameAttribute(): string
    {
        return $this->user_name[0];
    }

    public function isAuthor(Post $post): bool
    {
        return $this->id === $post->user_id;
    }

    public function getPostsCountAttribute(): int
    {
        return $this->posts()->count();
    }

    public function getCommentsCountAttribute(): int
    {
        return $this->comments()->count();
    }

    public function getImageAttribute(): string
    {
        return $this->avatar ? asset('/storage/profile-image/' . $this->avatar) : asset('blank-profile.svg');
    }

    // Check if user can post comment
    public function canUserPostComment($data)
    {
        return $data['latestCommentCreated']->diffInSeconds() > config('global.USER_COMMENT_DELAY');
    }

    public function getRatingAttribute(): float
    {
        $score = $this->comments->sum('likes_count');
        return $score > 0 ? (float)$score / 5 : 0;
    }

    public function isAdmin($user): bool
    {
        return $user->role == 'admin';
    }
}
