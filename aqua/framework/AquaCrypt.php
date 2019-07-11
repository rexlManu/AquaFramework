<?php


namespace aqua\framework;


class AquaCrypt
{

    public static function encrypt($data)
    {
        return openssl_encrypt($data, "AES-256-CBC", substr(env('APP_KEY'), 0, 16), 0, substr(env('APP_KEY'), 0, 16));
    }

    public static function decrypt($encryptedData)
    {
        return openssl_decrypt($encryptedData, "AES-256-CBC", substr(env('APP_KEY'), 0, 16), 0, substr(env('APP_KEY'), 0, 16));
    }

}