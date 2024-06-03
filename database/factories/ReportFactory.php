<?php

namespace Database\Factories;
use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    protected $model = Report::class;
    public function definition(): array
    {
        return [
            //
            'user_id' => $this->faker->numberBetween(1, 50),
            'school_id' => $this->faker->numberBetween(1, 50),
            'report' => fake()->paragraph(),

        ];
    }
}
