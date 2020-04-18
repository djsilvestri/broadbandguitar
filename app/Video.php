<?php

namespace App;
use Illuminate\Support\Str;

class Video extends Model
{
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    public function editable()
    {
        return auth()->check() && $this->channel->user_id === auth()->user()->id;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('comment_id')->orderBy('created_at', 'DESC');
    }
}
