<?php

namespace Database\Factories;
use App\Models\Addition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Addition>
 */
class AdditionFactory extends Factory
{
    protected $model = Addition::class;
    public function definition(): array
    {
        return [
            //
            'school_id' => $this->faker->numberBetween(1, 50),
            'student_id' => $this->faker->numberBetween(1, 50),
            'information_request' => fake()->paragraph(),
        ];
    }
}
