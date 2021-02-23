<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function post_adds_book_to_db()
    {
        $this->actingAs(User::factory()->create());
        $data = Book::factory()->make()->only(['title', 'remote_id']);
        $this->post(route('books.store'), $data)->assertRedirect(route('search'));
        $this->assertDatabaseHas('books', $data);
    }

    /** @test */
    public function guest_post_redirects_to_login()
    {
        $data = Book::factory()->create()->only(['title', 'remote_id']);
        $this->post(route('books.store'), $data)->assertRedirect(route('login'));
    }
}
