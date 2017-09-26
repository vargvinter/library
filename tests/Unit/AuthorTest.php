<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_author_has_books()
    {
        $author = create(\App\Author::class);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $author->books);
    }

    /** @test */
    public function an_author_has_a_country()
    {
        $author = create(\App\Author::class);

        $this->assertInstanceOf('App\Country', $author->country);
    }
}
