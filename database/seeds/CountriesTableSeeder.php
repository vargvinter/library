<?php

use Illuminate\Database\Seeder;
use App\Syncs\Countries;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return app()->make('App\Syncs\Countries')->sync();
    }
}
