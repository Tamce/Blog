<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\Helper;

class Post extends Model
{
    protected $fillable = [
        'topic', 'body', 'summary', 'uri'
    ];

    protected $hidden = [
        'id'
    ];

    public function __construct()
    {
        $this->hash = Helper::randomString(32);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
