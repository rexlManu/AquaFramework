<?php

namespace aqua;

use aqua\framework\AquaCookie;
use aqua\framework\AquaDatabase;
use aqua\framework\AquaRouter;
use aqua\framework\AquaSession;
use aqua\framework\providers\CookieAquaSession;
use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Kernel
{

    public static $env;
    public static $router;
    public static $twig;

    public static $providers = [
        'session' => CookieAquaSession::class,
        'database' => AquaDatabase::class
    ];

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

        AquaSession::getCurrent()->handle();

        if (!AquaCookie::has("_token")) {
            regenerateCsrfToken();
        }

        self::$router->run();
    }

}