<?php

namespace App\Services;

use GuzzleHttp\Client;

class IpService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getIp()
    {
        $response = $this->client->get('https://api.ipify.org?format=json');
        $data = json_decode($response->getBody(), true);

        return $data['ip'];
    }
}
