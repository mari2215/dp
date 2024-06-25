<?php

namespace Database\Factories;

use App\Models\EducationalQualification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EducationalQualification>
 */
class EducationalQualificationFactory extends Factory
{
    protected $model = EducationalQualification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'degree' => $this->faker->realText(10),
            'institution' => $this->faker->company,
            'start_date' => $this->faker->date(),
            'graduation_date' => $this->faker->date(),
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->boolean,
            'position' => $this->faker->numberBetween(1, 10),
        ];
    }
}
