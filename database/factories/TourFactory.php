<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //get random travel id from travel table
        $travelIds = \DB::table('travels')->inRandomOrder()->pluck('id')->toArray();

        return [
            //get random travel id from travel table
            'travel_id' => $this->faker->randomElement($travelIds),
            'name' => $this->faker->sentence(3),
            'start_date' => $this->faker->dateTimeBetween('now', '+1 years'),
            'end_date' => $this->faker->dateTimeBetween('+1 years', '+2 years'),
            'price' => $this->faker->numberBetween(1000, 10000),

        ];
    }
}
