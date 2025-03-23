<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    const GENDER = [
        'Male',
        'Female'
    ];

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
        'dob',
        'is_blocked',
        'is_hide',
        'avatar',
        'nickname'
    ];

    public function posts(): HasMany {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }

    public function likes(): BelongsToMany {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id')->withTimestamps();
    }

    public function hasLiked(Post $post) {
        return $this->likes()->where('post_id', $post->id)->exists();
    }

    public function follows (): BelongsToMany {
        return $this->belongsToMany(User::class,'follows','follower_id', 'user_id')->withTimestamps();
    }

    public function hasFollowed(User $user) {
        return $this->follows()->where('user_id', $user->id)->exists();
    }

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
    ];
}
