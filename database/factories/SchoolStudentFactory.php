<?php

namespace Database\Factories;
use App\Models\SchoolStudent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolStudent>
 */
class SchoolStudentFactory extends Factory
{
    protected $model = SchoolStudent::class;
    public function definition(): array
    {
        return [

            'student_id' => $this->faker->numberBetween(1, 50),
            'school_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
