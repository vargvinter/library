<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_has_an_author()
    {
        $book = create(\App\Book::class);

        $this->assertInstanceOf('App\Author', $book->author);
    }

    /** @test */
    public function a_book_has_translations()
    {
        $book = create(\App\Book::class);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $book->translations);
    }

    /** @test */
    public function a_book_has_translations_list_attribute()
    {
        $book = create(\App\Book::class);
        $translations = create(\App\Country::class, [], 2);

        $translations_ids = $translations->pluck('id')->toArray();
        
        $book->translations()->attach($translations_ids);

        $this->assertCount(2, $book->translations_list);
        $this->assertEquals($translations_ids, $book->translations_list);
    }
}
