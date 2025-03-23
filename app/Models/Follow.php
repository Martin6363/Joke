<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'follower_id',
    ];

    public function follows(): BelongsTo {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function isFollowedBy($userId): bool {
        return $this->follower_id === $userId;
    }
}
