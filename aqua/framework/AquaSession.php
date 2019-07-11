<?php


namespace aqua\framework;


interface AquaSession
{

    function create($expire = 86400);

    function id();

    function regenerate();

    function put(string $key, $object, $expire = 3600);

    function get(string $key);

    function destroy();

    function userAgent();

    function payload();

}