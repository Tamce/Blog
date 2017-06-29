<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'topic', 'body', 'summary'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
