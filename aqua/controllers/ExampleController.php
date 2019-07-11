<?php

namespace aqua\controllers;

use aqua\framework\AquaCookie;
use aqua\framework\AquaCrypt;
use aqua\framework\AquaRequest;
use aqua\framework\AquaSession;
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

        $name = AquaSession::getCurrent()->get('name');
        return $this->view('example', ['ip' => getRealUserIp(), 'name' => $name]);
    }

    public function postExample(AquaRequest $aquaRequest)
    {
        /*
         *      Run some code
         */

        AquaSession::getCurrent()->put('name', $aquaRequest->getData('name'));

        return $this->back();
    }

}