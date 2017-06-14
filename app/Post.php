<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'topic', 'body', 'created_by'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
