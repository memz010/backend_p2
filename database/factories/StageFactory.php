<?php

namespace Database\Factories;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stage>
 */
class StageFactory extends Factory
{
    protected $model = Stage::class;
    public function definition(): array
    {
        return [
            //
            'school_id' => $this->faker->numberBetween(1, 50),
            'name' => $this->faker->name,
        ];
    }
}
