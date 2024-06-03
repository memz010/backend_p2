<?php

namespace Database\Factories;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
    protected $model = Section::class;
    public function definition(): array
    {
        return [
            //
            'student_id' => $this->faker->numberBetween(1, 50),
            'stage_id' => $this->faker->numberBetween(1, 50),
            'count_of_student' => $this->faker->numberBetween(1, 50),
            'number_of_section' => $this->faker->numberBetween(1, 50),

        ];
    }
}
