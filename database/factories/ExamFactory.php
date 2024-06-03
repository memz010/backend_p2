<?php

namespace Database\Factories;
use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    protected $model = Exam::class;
    public function definition(): array
    {
        return [
            //
            'school_id' => $this->faker->numberBetween(1, 50),
             //'exam_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'exam_date' => now() ,
        ];
    }
}
