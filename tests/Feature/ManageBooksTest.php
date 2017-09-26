<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageBooksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_unauthenticated_user_may_not_create_books()
    {
        $this->get('/books/create')
            ->assertRedirect('/login');

        $this->post('/books')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_unauthenticated_user_may_not_edit_books()
    {
        $book = create(\App\Book::class);

        $this->get('/books/'. $book->id .'/edit')
            ->assertRedirect('/login');

        $this->put('/books/' . $book->id)
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_create_books()
    {
        $this->signIn();

        $this->get('/books/create')
            ->assertStatus(200)
            ->assertViewIs('books.create');

        $book = make(\App\Book::class);
        list($translationOne, $translationTwo) = create(\App\Country::class, [], 2);

        $data = array_add($book->toArray(), 'country_id', [$translationOne->id, $translationTwo->id]);

        $this->post('/books', $data);

        $this->assertDatabaseHas('books', [
            'title' => $book->title,
            'publish_date' => $book->publish_date,
            'author_id' => $book->author->id
        ]);

        $this->assertDatabaseHas('book_country', [
            'book_id' => \App\Book::first()->id,
            'country_id' => $translationOne->id
        ]);

        $this->assertDatabaseHas('book_country', [
            'book_id' => \App\Book::first()->id,
            'country_id' => $translationTwo->id
        ]);
    }

    /** @test */
    public function an_authenticated_user_can_edit_books()
    {
        $this->signIn();

        $book = create(\App\Book::class);
        $book->translations()->attach(create(\App\Country::class, [], 2)->pluck('id'));

        $this->get('/books/' . $book->id . '/edit')
            ->assertStatus(200)
            ->assertViewIs('books.edit');

        $editedBook = make(\App\Book::class);
        list($translationOne, $translationTwo) = create(\App\Country::class, [], 2);

        $data = array_add($editedBook->toArray(), 'country_id', [$translationOne->id, $translationTwo->id]);

        $this->put('/books/' . $book->id, $data);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => $editedBook->title,
            'author_id' => $editedBook->author->id
        ]);

        $this->assertDatabaseHas('book_country', [
            'book_id' => \App\Book::first()->id,
            'country_id' => $translationOne->id
        ]);

        $this->assertDatabaseHas('book_country', [
            'book_id' => \App\Book::first()->id,
            'country_id' => $translationTwo->id
        ]);

        $this->assertDatabaseMissing('books', $book->toArray());
    }

    /** @test */
    public function a_book_requires_a_title()
    {
        $this->createBook(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_book_requires_a_title_is_not_longer_than_50_characters()
    {
        $this->createBook(['title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.']) // 56
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_book_requires_a_publish_date()
    {
        $this->createBook(['publish_date' => null])
            ->assertSessionHasErrors('publish_date');
    }

    /** @test */
    public function a_book_requires_a_publish_date_has_correct_format()
    {
        $this->createBook(['publish_date' => '01-01-2012'])
            ->assertSessionHasErrors('publish_date');
    }

    /** @test */
    public function a_book_requires_an_author()
    {
        $this->createBook(['author_id' => null])
            ->assertSessionHasErrors('author_id');
    }

    /** @test */
    public function a_book_requires_an_existing_author()
    {
        $this->createBook(['author_id' => 1])
            ->assertSessionHasErrors('author_id');
    }

    /** @test */
    public function a_book_requires_a_country_or_countries()
    {
        $this->createBook(['country_id' => null])
            ->assertSessionHasErrors('country_id');
    }

    /** @test */
    public function a_book_requires_a_country_id_is_an_array()
    {
        $this->createBook(['country_id' => 'string'])
            ->assertSessionHasErrors('country_id');
    }

    protected function createBook($overrides = [])
    {
        $this->signIn();

        $book = make(\App\Book::class, $overrides);

        return $this->post('/books', $book->toArray());
    }
}
