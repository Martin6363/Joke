<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "reply_text",
        "user_id"
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
