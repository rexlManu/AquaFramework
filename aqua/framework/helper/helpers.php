<?php

use aqua\framework\AquaCookie;

function env(string $key, bool $localOnly = false)
{
    return getenv($key, $localOnly);
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function csrfToken()
{
    return AquaCookie::get("_token");
}

function regenerateCsrfToken()
{
    AquaCookie::set("_token", generateRandomString(16));
    return csrfToken();
}