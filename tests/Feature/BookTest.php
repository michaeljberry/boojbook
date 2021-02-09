<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_logged_in_user_can_allow_to_see_the_list_of_books()
    {
        $response = $this->get('/home')->assertRedirect('/login');
    }

    public function test_authenticate_user_can_see_list_of_books()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get('/home')->assertStatus(200);
    }

    public function test_user_can_add_book()
    {
        // $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $response = $this->post('/book', [
            'title' => 'The Uncanny Counter',
            'author' => 'Lee Jon Hyung',
            'photo' => UploadedFile::fake()->image('book_cover.jpg'),
            'date_publish' => Carbon::now()->format('Y-m-d'),
            'user_id' => 1
        ]);
        
        $this->assertCount(1, Book::all());
    }

    public function test_user_can_update_book()
    {
        // $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());

        $this->post('/book', [
            'title' => 'The Uncanny Counter',
            'author' => 'Lee Jon Hyung',
            'photo' => UploadedFile::fake()->image('book_cover.jpg'),
            'date_publish' => Carbon::now()->format('Y-m-d'),
            'user_id' => 1
        ]);

        $response = $this->put('/book/1', [
            'title' => 'The Uncanny Counter Season 2',
            'author' => 'Lee Jon Hyung',
            'photo' => UploadedFile::fake()->image('book_cover.jpg'),
            'date_publish' => Carbon::now()->format('Y-m-d')
        ]);
        
        $this->assertCount(1, Book::all());
    }

    public function test_user_can_delete_book()
    {
        // $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());

        $this->post('/book', [
            'title' => 'The Uncanny Counter',
            'author' => 'Lee Jon Hyung',
            'photo' => UploadedFile::fake()->image('book_cover.jpg'),
            'date_publish' => Carbon::now()->format('Y-m-d'),
            'user_id' => 1
        ]);

        $response = $this->delete('/book/1');
        
        $this->assertCount(0, Book::all());
    }
}
