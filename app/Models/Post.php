<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{


    protected $fillable = [
        'name',
        'title',
        'website_id'
    ];

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    public function postNotificationStatus(): HasOne
    {
        return $this->hasOne(PostNotificationStatus::class, 'post_id');
    }
}
