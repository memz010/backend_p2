<?php

namespace Database\Factories;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grade>
 */
class GradeFactory extends Factory
{
    protected $model = Grade::class;

    public function definition(): array
    {
        return [
            //
            'student_id' => $this->faker->numberBetween(1, 50),
            'exam_id' => $this->faker->numberBetween(1, 50),
            'grade' => $this->faker->numberBetween(1,10),
        ];
    }
}
