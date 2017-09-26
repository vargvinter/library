<?php

namespace App\Countries;

use GuzzleHttp\Client;
use Cache;

class CountriesApi
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function all()
    {
        return Cache::remember('countries', 1, function() {
            $response = $this->client->get('https://restcountries.eu/rest/v2/all');

            $a = json_decode($response->getBody());

            $data = [];

            foreach ($a as $country) {
                $data[$country->alpha2Code] = $country->name;
            }

            return $data;
        });
    }
}
