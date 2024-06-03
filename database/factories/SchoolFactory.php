<?php

namespace Database\Factories;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\School>
 */
class SchoolFactory extends Factory
{
    protected $model = School::class;
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->name,
            'type' => fake()->word(),
            'age_stage' => fake()->word(),
            'address' => fake()->word(),
            'Subscription_price' => $this->faker->numberBetween(100, 500),


        ];
    }
}
