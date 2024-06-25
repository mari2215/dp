<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Generate random start date within range
        $startDate = $this->faker->dateTimeBetween('+1 days', '+10 days')->format('Y-m-d H:i:s');
        $endDate = $this->faker->dateTimeBetween($startDate, '+12 days')->format('Y-m-d H:i:s');

        return [
            'name' => $this->faker->realText(12),
            'start' => $startDate,
            'end' => $endDate,
            'description' => $this->faker->realText(1000),
            'location' => $this->faker->address,
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'category_id' => null,
            'status' => $this->faker->boolean,
            'position' => $this->faker->numberBetween(1, 10),
        ];
    }
}
