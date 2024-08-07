<?php

namespace App\Services;

use GuzzleHttp\Client;

class LocationService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('IPSTACK_API_KEY');
    }

    public function getLocation($ip)
    {
        $url = "https://api.ipgeolocation.io/ipgeo?apiKey=7bec4124168a4444be2da8e124057a0f&ip=".$ip;

        // key: 7bec4124168a4444be2da8e124057a0f
        // curl: https://api.ipgeolocation.io/ipgeo?apiKey=API_KEY&ip=8.8.8.8
        $response = $this->client->get($url);
        $data = json_decode($response->getBody(), true);

        return $data;
    }
}
