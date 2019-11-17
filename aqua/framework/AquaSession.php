<?php


namespace aqua\framework;


use aqua\framework\providers\CookieAquaSession;
use aqua\Kernel;

abstract class AquaSession
{

    abstract function create($expire = 86400);

    abstract function id();

    abstract function regenerate();

    abstract function put(string $key, $object, $expire = 3600);

    abstract function get(string $key);

    abstract function destroy();

    abstract function userAgent();

    abstract function payload();

    abstract function handle();

    public static function getCurrent(): AquaSession
    {
        return new Kernel::$providers['session'];
    }

}