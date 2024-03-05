<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        if(!Storage::drive('public')->exists('post-images')) {
            Storage::drive('public')->makeDirectory('post-images');
        }
        $userId = User::inRandomOrder()->first();
        $companyId = Category::inRandomOrder()->first();

        return [
            "title"=> fake()->title(),
            "description" => fake()->paragraph(),
            "category_id"=> $companyId ? $companyId->id : '',
            "user_id" => $userId ? $userId->id : '',
            "image" => fake()->imageUrl(640, 480, 'animals', true),
            "published" => fake()->boolean(),
        ];
    }
}
