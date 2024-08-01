<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grocery>
 */
class GroceryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'item' => fake()->word,
            'purchased_at' => fake()->dateTimeThisYear,
        ];
    }

    /**
     * Indicate that the grocery item has not been purchased.
     *
     * @return \Database\Factories\GroceryFactory
     */
    public function notPurchased(): GroceryFactory
    {
        return $this->state([
            'purchased_at' => null,
        ]);
    }
}
