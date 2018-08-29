<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\Helper;

class Post extends Model
{
    protected $fillable = [
        'topic', 'body', 'summary', 'shortname'
    ];

    protected $hidden = [
        'id', 'created_by'
    ];

    public function __construct()
    {
        $this->hash = Helper::randomString(32);
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
