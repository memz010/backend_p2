<?php

namespace Database\Factories;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    protected $model = Subject::class;
    public function definition(): array
    {
        return [
            //
            'id_stage' => $this->faker->numberBetween(1, 50),
            'name' => $this->faker->name,
            'semester' => $this->faker->numberBetween(1, 3),
            'lectuer_per_week' => $this->faker->numberBetween(10, 50),

        ];
    }
}
