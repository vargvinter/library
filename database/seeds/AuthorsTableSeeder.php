<?php

use App\Country;
use Illuminate\Database\Seeder;

use App\Author;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<20; $i++) {
            factory(Author::class)->create([
                'country_id' => Country::inRandomOrder()->first()->id
            ]);
        }
    }
}
