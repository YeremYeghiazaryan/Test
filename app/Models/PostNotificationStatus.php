<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PostNotificationStatus extends Model
{
    protected $fillable = [
        'post_id',
        'sent'
    ];

    public function post() :belongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

}
