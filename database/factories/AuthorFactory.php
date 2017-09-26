<?php

use Faker\Generator as Faker;

$factory->define(App\Author::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'country_id' => function() {
            return factory(App\Country::class)->create()->id;
        }
    ];
});
