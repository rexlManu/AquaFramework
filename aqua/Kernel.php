<?php

namespace aqua;

use aqua\framework\AquaRouter;
use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Kernel
{

    public static $env;
    public static $router;
    public static $twig;

    public static function boot()
    {
        self::$env = Dotenv::create('..\\');
        self::$env->load();
        self::$router = AquaRouter::getInstance();
        self::$twig = new Environment(new FilesystemLoader(__DIR__ . '\views'), ['cache' => /*'..\aqua\cache'*/ false]);

        require_once 'framework/helper/helpers.php';

        $router = self::$router;
        foreach (glob(__DIR__ . '/routes/*.php') as $file) {
            require_once $file;
        }

        self::$router->run();
    }

}