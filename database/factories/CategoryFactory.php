<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(15),
            'subtitle' => $this->faker->realText(70),
            'description' => $this->faker->realText(1000),
            'status' => $this->faker->boolean,
            'position' => $this->faker->numberBetween(1, 10),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
