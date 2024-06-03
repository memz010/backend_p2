<?php

namespace Database\Factories;
use App\Models\Request;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    protected $model = Request::class;
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
