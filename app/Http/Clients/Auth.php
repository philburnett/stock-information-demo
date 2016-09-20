<?php

namespace App\Http\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/**
 * Class Auth
 *
 * @package App\Http\Clients
 */
class Auth
{
    const ENDPOINT = 'https://ci-authentication.dev.mmgapi.net/session/keep-alive/';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Response
     */
    private $response;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $token
     *
     * @return bool
     */
    public function get($token)
    {
        // todo: validate token
        $url = self::ENDPOINT . $token;

        try {
            $this->response = $this->client->get($url);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getResponse()
    {
        $body = $this->response->getBody()->getContents();
        return json_decode($body, true);
    }
}
