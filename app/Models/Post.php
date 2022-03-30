<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'img',
        'slug'
    ];

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
}
