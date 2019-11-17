<?php

namespace aqua\framework\providers;

use aqua\framework\AquaCookie;
use aqua\framework\AquaCrypt;
use aqua\framework\AquaSession;

class CookieAquaSession extends AquaSession
{

    private $data;

    public function __construct()
    {
        $this->handle();
        if (AquaCookie::has($this->getSessionName())) {
            $this->data = json_decode(AquaCookie::get($this->getSessionName()), true);
        } else {
            $this->data = [];
            $this->create();
        }
    }

    function getSessionName()
    {
        return env('APP_NAME') . '_session';
    }

    function create($expire = 86400)
    {
        $this->data['expire'] = time() + $expire;
        AquaCookie::set($this->getSessionName(), $this->payload());
        $this->regenerate();
    }

    function id()
    {
        return $this->get('id');
    }

    function regenerate()
    {
        $this->put('id', generateRandomString(16));
        return $this->id();
    }

    function put(string $key, $object, $expire = 3600)
    {
        $this->data[$key] = $object;
        $this->data[$key . '_expire'] = time() + $expire;
        AquaCookie::set($this->getSessionName(), $this->payload());
    }

    function get(string $key)
    {
        $this->data = json_decode(AquaCookie::get($this->getSessionName()), true);
        if (array_key_exists($key . '_expire', $this->data) && $this->data[$key . '_expire'] < time()) {
            unset($this->data[$key . '_expire']);
            unset($this->data[$key]);
            AquaCookie::set($this->getSessionName(), $this->payload());
            return null;
        }
        if (array_key_exists($key, $this->data))
            return $this->data[$key];
        else return null;
    }

    function destroy()
    {
        AquaCookie::delete($this->getSessionName());
    }

    function userAgent()
    {
    }

    function payload()
    {
        return json_encode($this->data);
    }

    function handle()
    {
    }
}