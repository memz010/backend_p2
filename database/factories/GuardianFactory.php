<?php

namespace Database\Factories;
use App\Models\Guardian;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guardian>
 */
class GuardianFactory extends Factory
{
    protected $model = Guardian::class;

    public function definition(): array
    {
        return [
            'guardian_id' => $this->faker->numberBetween(1, 50),
            'student_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
