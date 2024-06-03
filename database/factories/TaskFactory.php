<?php

namespace Database\Factories;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    public function definition(): array
    {
        return [
            //
            'subject_id' => $this->faker->numberBetween(1, 15),
            'title' => fake()->word(),
            'uploaded_date' => now(),
            'deadline' => now(),
            'start_of_submissions_date' =>now(),
            'description' => fake()->paragraph(),
        ];
    }
}
