<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'author_id' => function() {
            return factory(App\Author::class)->create()->id;
        },
        'publish_date' => $faker->date
    ];
});
