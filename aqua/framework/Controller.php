<?php


namespace aqua\framework;


use aqua\Kernel;

class Controller
{

    public function view(string $view, array $params = [])
    {
        $params['_token'] = AquaCrypt::encrypt(csrfToken());
        return Kernel::$twig->render($view . '.aqua.php', $params);
    }

    public function back()
    {
        $previous = "javascript://history.go(-1)";
        if (isset($_SERVER['HTTP_REFERER'])) {
            $previous = $_SERVER['HTTP_REFERER'];
        }
        header('Location: ' . $previous);
        return $this;
    }
}