<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rate>
 */
class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userId = User::inRandomOrder()->first();
        $postId = Post::inRandomOrder()->first();

        return [
            "user_id" => $userId->id,
            "post_id"=> $postId->id,
            "rate" => fake()->numberBetween(0, 5),
        ];
    }
}
