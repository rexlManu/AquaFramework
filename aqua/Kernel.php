<?php

namespace aqua;

use aqua\framework\AquaRouter;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Kernel
{

    public static $router;
    public static $twig;

    public static function boot()
    {
        self::$router = AquaRouter::getInstance();
        self::$twig = new Environment(new FilesystemLoader(__DIR__ . '\views'), ['cache' => /*'..\cache'*/ false]);

        $router = self::$router;
        foreach (glob(__DIR__ . '/routes/*.php') as $file) {
            require_once $file;
        }

        self::$router->run();
    }

}