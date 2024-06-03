<?php

namespace Database\Factories;
use App\Models\Librarie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Librarie>
 */
class LibrarieFactory extends Factory
{
    protected $model = Librarie::class;
    public function definition(): array
    {
        return [
            //
            'school_id' => $this->faker->numberBetween(1, 50),
            'description' => fake()->paragraph(),
            'type' => fake()->word(),

        ];
    }
}
