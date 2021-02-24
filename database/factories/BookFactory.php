<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'     => $this->faker->words(3, true),
            'remote_id' => Str::random(),
            'user_id'   => fn() => User::factory()->create()->id,
        ];
    }
}
