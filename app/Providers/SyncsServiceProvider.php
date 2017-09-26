<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use GuzzleHttp\Client;

use App\Syncs\Countries;

class SyncsServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Syncs\Countries', function() {
            return new Countries(new Client());
        });
    }
}
