<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    protected $fillable = [
        "website_id",
        "user_id",
    ];

    public function website(): belongsTo
    {
        return $this->belongsTo(Post::class, 'website_id');
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
