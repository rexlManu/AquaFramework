<?php


namespace aqua\framework;


use aqua\Kernel;

class Controller
{

    public function view(string $view, array $params = [])
    {
        return Kernel::$twig->render($view . '.aqua.php', $params);
    }

}