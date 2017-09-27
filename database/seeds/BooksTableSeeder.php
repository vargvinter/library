<?php

use Illuminate\Database\Seeder;
use App\Author;
use App\Book;
use App\Country;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<60; $i++) {
            $book = factory(Book::class)->create([
                'author_id' => Author::inRandomOrder()->first()->id
            ]);

            $countries_ids = Country::inRandomOrder()->limit(rand(1, 10))->pluck('id')->toArray();

            $book->translations()->attach($countries_ids);
        }
    }
}
