<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrowseBooksTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_can_filter_books_by_its_title()
    {
        $book = create(\App\Book::class, ['title' => 'Fight Club']);
        $anotherBook = create(\App\Book::class, ['title' => 'The Witcher']);

        $this->get('/books?title=club')
            ->assertSee($book->title)
            ->assertDontSee($anotherBook->title);
    }

    /** @test */
    public function it_can_filter_books_by_its_author()
    {
        $author = create(\App\Author::class, ['name' => 'Chuck', 'surname' => 'Palahniuk']);
        $anotherAuthor = create(\App\Author::class, ['name' => 'Andrzej', 'surname' => 'Sapkowski']);

        $book = create(\App\Book::class, ['author_id' => $author->id]);
        $anotherBook = create(\App\Book::class, ['author_id' => $anotherAuthor->id]);

        $this->get('/books?author=chuck')
            ->assertSee($book->title)
            ->assertDontSee($anotherBook->title);

        $this->get('/books?author=palahniuk')
            ->assertSee($book->title)
            ->assertDontSee($anotherBook->title);

        $this->get('/books?author=chuck palahniuk')
            ->assertSee($book->title)
            ->assertDontSee($anotherBook->title);

        $this->get('/books?author=palahniuk chuck')
            ->assertSee($book->title)
            ->assertDontSee($anotherBook->title);
    }

    /** @test */
    public function it_can_filter_books_by_its_translation()
    {
        $book = create(\App\Book::class);
        $anotherBook = create(\App\Book::class);

        $country = create(\App\Country::class, ['name' => 'United States of America']);
        $anotherCountry = create(\App\Country::class, ['name' => 'Poland']);

        $book->translations()->attach($country->id);
        $anotherBook->translations()->attach($anotherCountry->id);

        $this->get('/books?translation=America')
            ->assertSee($book->title)
            ->assertDontSee($anotherBook->title);
    }
}
