<?php

namespace Database\Factories\Api\Room;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'room_floor' => fake()->numberBetween(0, 50),
            'room_number' => fake()->numberBetween(0, 500),
            'short_desc' => fake()->text(200),
            'is_book' => fake()->numberBetween(0, 1)
        ];
    }
}
