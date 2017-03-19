<?php

namespace Emag\Lib\Getter;

use GuzzleHttp\Client;

/**
 * Class HttpGetter
 * @package Emag\Lib\Getter
 */
class HttpGetter
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var Client
     */
    protected $client;

    public function __construct($url)
    {
        $this->url = $url;
        $this->client = new Client();
    }

    /**
     * downloads data from $this->url URL
     * @throws \Exception
     * @return string $data downloaded data
     */
    public function getData()
    {
        $response = $this->client->get($this->url);
        if (200 !== $response->getStatusCode()) {
            throw new \Exception(sprintf('Error. Get data return code: %d', $response->getStatusCode()));
        }

        return (string)$response->getBody();
    }
}
