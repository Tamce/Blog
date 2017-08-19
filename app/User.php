<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use App\Support\Helper;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $fillable = [
        'name', 'nick', 'password'
    ];

    protected $hidden = [
        'id', 'password', 'remember_token', 'updated_at'
    ];

    public function __construct()
    {
        $this->hash = Helper::randomString(32);
    }

    public function posts()
    {
        return $this->hasMany('App\Post', 'created_by');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = password_hash($value, PASSWORD_BCRYPT);
    }

    public function auth($password)
    {
        return password_verify($password, $this->password);
    }
}
