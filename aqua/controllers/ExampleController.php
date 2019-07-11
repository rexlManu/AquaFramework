<?php

namespace aqua\controllers;

use aqua\framework\AquaCookie;
use aqua\framework\AquaCrypt;
use aqua\framework\AquaRequest;
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
        $encryptedData = "QdD4YXKBxiqS40l3fHngtg==";
        return $encryptedData . '<br>' . AquaCrypt::decrypt($encryptedData) . '<br>test';
        return $this->view('example', ['ip' => getRealUserIp()]);
    }

    public function postExample(AquaRequest $aquaRequest)
    {
        /*
         *      Run some code
         */

        return $this->back();
    }

}