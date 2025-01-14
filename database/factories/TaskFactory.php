<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
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
            "user_id" => User::pluck("id")->random(),
            "title" => fake()->sentence(6),
            "description" => fake()->text(300),
            "is_completed" => fake()->boolean(30),
            "date_limit" => fake()->dateTimeBetween("now", "+1 month")->format("Y-m-d"),
        ];
    }
}
