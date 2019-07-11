<?php

namespace aqua\framework\providers;

use aqua\framework\AquaCrypt;
use aqua\framework\AquaSession;

class NormalAquaSession extends AquaSession
{

    private $data;

    public function __construct()
    {
        $this->handle();
        if (array_key_exists('payload', $_SESSION)) {
            $this->data = json_decode(AquaCrypt::decrypt($_SESSION['payload']), true);
        } else {
            $this->data = [];
            $this->create();
        }
    }

    function create($expire = 86400)
    {
        session_create_id(env('APP_NAME'));
        $this->data['expire'] = time() + $expire;
        $_SESSION['payload'] = $this->payload();
    }

    function id()
    {
        return session_id();
    }

    function regenerate()
    {
        return session_regenerate_id(false);
    }

    function put(string $key, $object, $expire = 3600)
    {
        $this->data[$key] = $object;
        $this->data[$key . '_expire'] = time() + $expire;
        $_SESSION['payload'] = $this->payload();
    }

    function get(string $key)
    {
        $this->data = json_decode(AquaCrypt::decrypt($_SESSION['payload']), true);
        if (array_key_exists($key . '_expire', $this->data) && $this->data[$key . '_expire'] < time()) {
            unset($this->data[$key . '_expire']);
            unset($this->data[$key]);
            $_SESSION['payload'] = $this->payload();
            return null;
        }
        if (array_key_exists($key, $this->data))
            return $this->data[$key];
        else return null;
    }

    function destroy()
    {
        session_destroy();
    }

    function userAgent()
    {
    }

    function payload()
    {
        return AquaCrypt::encrypt(json_encode($this->data));
    }

    function handle()
    {
        if (!(session_status() == PHP_SESSION_ACTIVE))
            session_start();
    }
}