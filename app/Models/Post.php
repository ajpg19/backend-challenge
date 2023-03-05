<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function setRatingAttribute()
    {
        $title = $this->attributes['title'];
        $body = $this->attributes['body'];

        $rating = str_word_count($title)*2 + str_word_count($body);

        $this->attributes['rating'] = $rating;
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
