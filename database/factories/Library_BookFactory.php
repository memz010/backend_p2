<?php

namespace Database\Factories;
use App\Models\Library_Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Library_Book>
 */
class Library_BookFactory extends Factory
{
    protected $model = Library_Book::class;
    public function definition(): array
    {
        return [
            //
            'library_id' => $this->faker->numberBetween(1, 50),
            'name' => $this->faker->name,
            'description' => fake()->paragraph(),
            'author' => $this->faker->name,
            'type' => fake()->word(),
            'pages' => $this->faker->numberBetween(100, 500),
        ];
    }
}
