<?php

namespace Database\Factories;
use App\Models\Submission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Submission>
 */
class SubmissionFactory extends Factory
{
    protected $model = Submission::class;
    public function definition(): array
    {
        return [
            //
            'task_id' => $this->faker->numberBetween(1, 15),
            'description' =>  fake()->word(),
        ];
    }
}
