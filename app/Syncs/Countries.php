<?php

namespace App\Syncs;

use GuzzleHttp\Client;
use App\Country;

class Countries implements Syncable
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function sync()
    {
        $response = $this->client->get('https://restcountries.eu/rest/v2/all');

        $countries = json_decode($response->getBody());

        foreach ($countries as $country) {
            Country::firstOrCreate(['name' => $country->name], ['name' => $country->name]);
        }
    }
}
