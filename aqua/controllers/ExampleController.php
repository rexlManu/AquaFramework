<?php

namespace aqua\controllers;

use aqua\framework\Controller;

class ExampleController extends Controller
{

    public function example()
    {
        function getRealUserIp()
        {
            switch (true) {
                case (!empty($_SERVER['HTTP_X_REAL_IP'])) :
                    return $_SERVER['HTTP_X_REAL_IP'];
                case (!empty($_SERVER['HTTP_CLIENT_IP'])) :
                    return $_SERVER['HTTP_CLIENT_IP'];
                case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) :
                    return $_SERVER['HTTP_X_FORWARDED_FOR'];
                default :
                    return $_SERVER['REMOTE_ADDR'];
            }
        }

        return $this->view('example', ['ip' => getRealUserIp()]);
    }

}