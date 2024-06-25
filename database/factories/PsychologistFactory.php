<?php

namespace Database\Factories;

use App\Models\Psychologist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Psychologist>
 */
class PsychologistFactory extends Factory
{
    protected $model = Psychologist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'title' => $this->faker->jobTitle,
            'subtitle' => $this->faker->realText(1000),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'image' => [
                'url' => $this->faker->imageUrl(),
                'alt' => 'Psychologist Image',
            ],
            'instagram' => $this->faker->userName,
            'telegram' => $this->faker->userName,
            'viber' => $this->faker->userName,
            'facebook' => $this->faker->userName,
            'youtube_title' => $this->faker->realText(250),
            'video_url' => 'https://www.youtube.com/watch?v=' . $this->faker->regexify('[A-Za-z0-9_\-]{11}'),
        ];
    }
}
