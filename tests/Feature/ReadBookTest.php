<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\ReadingIntervals;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReadBookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_not_valid_create_reading_intervals(): void
    {
        $userData = [
            'book_id' => 1,
            'user_id' => 1,
            'start_page' => 2,
            'end_page' => 10
        ];

        // Send a POST request to your API endpoint
        $response = $this->postJson('/api/books/reading', $userData);

        // Assert that the request was not valid (HTTP status code 422 - validation)
        $response->assertStatus(422);

        // Assert that the response contains the validation message
        $response->assertJson([
            'message' => 'Invalid data send',
        ]);
    }

    /**
     * @return void
     */
    public function test_valid_create_reading_intervals()
    {

        $user = User::factory()->create();

        $book = Book::factory()->create();

        $data = [
            'book_id' => $user->id,
            'user_id' => $book->id,
            'start_page' => 2,
            'end_page' => 10
        ];

        // Send a POST request to your API endpoint
        $response = $this->postJson('/api/books/reading', $data);

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'successfully',
            'errors' => null,
            'data' => $data
        ]);

        // Assert that the user is actually stored in the database
        $this->assertDatabaseHas('reading_intervals', $data);
    }
    /**
     * @return void
     */
    public function test_valid_create_reading_recommended()
    {
        $this->refreshTestDatabase();

        $user = User::factory(3)->create();

        $book = Book::factory(2)->create();

         $data  = [
            [
                'user_id' => $user[0]->id,
                'book_id' => $book[0]->id,
                'start_page' => 10,
                'end_page' => 30,
            ],
            [
                'user_id' => $user[1]->id,
                'book_id' => $book[0]->id,
                'start_page' => 2,
                'end_page' => 25,
            ],
            [
                'user_id' => $user[0]->id,
                'book_id' => $book[1]->id,
                'start_page' => 40,
                'end_page' => 50,
            ],
            [
                'user_id' => $user[2]->id,
                'book_id' => $book[1]->id,
                'start_page' => 1,
                'end_page' => 10,
            ]
        ];

        ReadingIntervals::insert($data);

        $response = $this->getJson('/api/books/recommended');

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'successfully',
            'errors' => null,
            'data' => [
                [
                    'num_of_read_pages' => 29
                ],
                [
                    'num_of_read_pages' => 21
                ]
            ]
        ]);

    }
}
