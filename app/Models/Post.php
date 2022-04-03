<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'img',
        'slug',
        'category_id',
        'user_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    // SHORTER TEXT
    public function trunText($lenght)
    {
        return Str::limit($this->content, $lenght);
    }
    // ITA DATE
    public function itaDate()
    {
        // return Carbon::createFromFormat('d-m-Y', $this->updated_at);
        return Carbon::create($this->updated_at)->format('d-F-Y');
    }
}
