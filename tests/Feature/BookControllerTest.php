<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function post_adds_book_to_db()
    {
        $this->actingAs(User::factory()->create());
        $data = Book::factory()->make()->only(['title', 'remote_id']);
        $this->post(route('books.store'), $data)
            ->assertSuccessful()
            ->assertJsonFragment($data);
        $this->assertDatabaseHas('books', $data);
    }

    /** @test */
    public function guest_post_redirects_to_login()
    {
        $data = Book::factory()->create()->only(['title', 'remote_id']);
        $this->post(route('books.store'), $data)->assertRedirect(route('login'));
    }

    /** @test */
    public function delete_removes_from_db()
    {
        $this->actingAs(User::factory()->create());
        $book = Book::factory()->create(['user_id' => Auth::id()]);
        $this->deleteJson(route('books.destroy', $book))->assertSuccessful();
        $this->assertDatabaseMissing('books', $book);
    }

    /** @test */
    public function non_owner_delete_forbidden()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $book = Book::factory()->create(['user_id' => $user1->id]);
        $this->actingAs($user2);
        $this->deleteJson(route('books.destroy', $book))->assertForbidden();
    }
}
