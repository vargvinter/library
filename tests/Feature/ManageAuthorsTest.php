<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageAuthorsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_unauthenticated_user_may_not_create_authors()
    {
        $this->get('/authors/create')
            ->assertRedirect('/login');

        $this->post('/authors')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_unauthenticated_user_may_not_edit_authors()
    {
        $author = create(\App\Author::class);

        $this->get('/authors/'. $author->id .'/edit')
            ->assertRedirect('/login');

        $this->put('/authors/' . $author->id)
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_create_authors()
    {
        $this->signIn();

        $this->get('/authors/create')
            ->assertStatus(200)
            ->assertViewIs('authors.create');

        $author = make(\App\Author::class);

        $this->post('/authors', $author->toArray());

        $this->assertDatabaseHas('authors', [
            'name' => $author->name,
            'surname' => $author->surname,
            'country_id' => $author->country->id
        ]);
    }

    /** @test */
    public function an_authenticated_user_can_edit_authors()
    {
        $this->signIn();

        $author = create(\App\Author::class);
        $this->assertDatabaseHas('authors', $author->toArray());

        $this->get('/authors/' . $author->id . '/edit')
            ->assertStatus(200)
            ->assertViewIs('authors.edit');

        $editedAuthor = make(\App\Author::class);

        $this->put('/authors/' . $author->id, $editedAuthor->toArray());

        $this->assertDatabaseHas('authors', [
            'id' => $author->id,
            'name' => $editedAuthor->name,
            'surname' => $editedAuthor->surname,
            'country_id' => $editedAuthor->country->id
        ]);

        $this->assertDatabaseMissing('authors', $author->toArray());
    }

    /** @test */
    public function an_author_requires_a_name()
    {
        $this->createAuthor(['name' => null])
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function an_author_requires_a_name_is_not_longer_than_40_characters()
    {
        $this->createAuthor(['name' => 'Lorem ipsum dolor sit amet, consectetur adipiscing.'])
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function an_author_requires_a_surname()
    {
        $this->createAuthor(['surname' => null])
            ->assertSessionHasErrors('surname');
    }

    /** @test */
    public function an_author_requires_a_surname_is_not_longer_than_40_characters()
    {
        $this->createAuthor(['surname' => 'Lorem ipsum dolor sit amet, consectetur adipiscing'])
            ->assertSessionHasErrors('surname');
    }

    /** @test */
    public function an_author_requires_a_country()
    {
        $this->createAuthor(['country_id' => null])
            ->assertSessionHasErrors('country_id');
    }

    /** @test */
    public function an_author_requires_an_existing_country()
    {
        $this->createAuthor(['country_id' => 999999999])
            ->assertSessionHasErrors('country_id');
    }

    protected function createAuthor($overrides = [])
    {
        $this->signIn();

        $author = make(\App\Author::class, $overrides);

        return $this->post('/authors', $author->toArray());
    }
}
