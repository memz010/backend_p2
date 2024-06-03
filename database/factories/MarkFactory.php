<?php

namespace Database\Factories;
use App\Models\Mark;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mark>
 */
class MarkFactory extends Factory
{
    protected $model = Mark::class;
    public function definition(): array
    {
        return [
            //
         'student_id' => $this->faker->numberBetween(1, 50),
         'submission_id' => $this->faker->numberBetween(1, 50),
         'mark' => $this->faker->numberBetween(1, 10),
         'note' => fake()->word(),
        ];
    }
}
