<?php


namespace aqua\framework;


class AquaCookie
{

    public static function set(string $key, $object, int $expire = 43200, bool $httpOnly = false, $path = '', $domain = '')
    {
        return setcookie($key, AquaCrypt::encrypt($object));
    }

    public static function get(string $key)
    {
        return AquaCrypt::decrypt($_COOKIE[$key]);
    }

    public static function has(string $key)
    {
        return array_key_exists($key, $_COOKIE);
    }

    public static function delete(string $key)
    {
        if (self::has($key)) {
            unset($_COOKIE[$key]);
            setcookie($key, '', time() - 3600);
        }
    }

}