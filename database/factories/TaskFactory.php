<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'description' => fake()->paragraph(),
            'due_date' => fake()->dateTimeBetween('-2 week','+2 week'),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'client_id' => Client::inRandomOrder()->first()->id ?? Client::factory()
        ];
    }
}
