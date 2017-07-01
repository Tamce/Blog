<?php
namespace App\Support;

class Helper
{
    static function randomString($n, $pool = null)
    {
        if (null == $pool) {
            $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        }
        $result = '';
        while ($n > 0) {
            $result .= $pool[rand(0, strlen($pool) - 1)];
            $n--;
        }
        return $result;
    }
}
