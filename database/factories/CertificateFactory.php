<?php

namespace Database\Factories;
use App\Models\Certificate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certificate>
 */
class CertificateFactory extends Factory
{
    protected $model = Certificate::class;
    public function definition(): array
    {
        return [
            //
            'user_id' => $this->faker->numberBetween(1, 50),
            'school_id' => $this->faker->numberBetween(1, 50),
            'title' => fake()->word(),
            'file' => $this->faker->randomElement(['binary_data_1', 'binary_data_2', 'binary_data_3']),
            'description' => fake()->paragraph(),
        ];
    }
}
