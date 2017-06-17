<?php
namespace App\Support;

class Session
{
    static protected $segmentName = '__tmc_session_control';
    static public function set($key, $value = null)
    {
        if ($value == null) {
            unset($_SESSION[self::$segmentName][$key]);
            return null;
        }
        $_SESSION[self::$segmentName][$key] = $value;
        return $value;
    }

    static public function remove($key)
    {
        return self::set($key);
    }

    static public function removeAll()
    {
        $_SESSION[self::$segmentName] = [];
    }

    static public function get($key, $default = null)
    {
        return isset($_SESSION[self::$segmentName][$key]) ? $_SESSION[self::$segmentName][$key] : $default;
    }

    static public function destroy()
    {
        session_destroy();
    }

    static public function start()
    {
        session_start();
        if (empty($_SESSION[self::$segmentName])) {
            $_SESSION[self::$segmentName] = [];
        }
    }

    static public function restart()
    {
        self::destory();
        self::start();
    }
}

Session::start();
