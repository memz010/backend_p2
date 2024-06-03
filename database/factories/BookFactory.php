<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Subject;
use App\Models\Library_Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            //
            'subject_id' => $this->faker->numberBetween(1, 50),
            'book_id' => $this->faker->numberBetween(1, 50),
            'assosiation_level' => $this->faker->numberBetween(1, 5),
        ];
    }
}
