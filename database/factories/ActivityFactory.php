<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(30),
            'price' => $this->faker->randomFloat(2, 10, 1000), // Random price between 10.00 and 1000.00
            'description' => $this->faker->realText(1000),
            'category_id' => null,
            'status' => $this->faker->boolean,
            'image' => $this->faker->imageUrl(),
            'position' => $this->faker->numberBetween(1, 10),
        ];
    }
}
