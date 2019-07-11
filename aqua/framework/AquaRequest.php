<?php

namespace aqua\framework;

class AquaRequest
{

    private $currentUri;
    private $requestHeaders;

    /**
     * AquaRequest constructor.
     * @param $currentUri
     * @param $requestHeaders
     */
    public function __construct($currentUri, $requestHeaders)
    {
        $this->currentUri = $currentUri;
        $this->requestHeaders = $requestHeaders;
    }

    /**
     * @return mixed
     */
    public function getCurrentUri()
    {
        return $this->currentUri;
    }

    /**
     * @return mixed
     */
    public function getRequestHeaders()
    {
        return $this->requestHeaders;
    }

    public function getData(string $key = null)
    {
        if ($key != null) return $this->getData()[$key];
        return $_POST;
    }

}