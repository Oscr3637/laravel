<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $name = $this->faker->sentence;
        return [
            'title' => $name,
            'slug' => str($name)->slug(),
            'content' => $this->faker->paragraphs(5, true),
            'description' => $this->faker->sentence(1, true),
            'category_id' => $this->faker->randomElement([1, 2, 3]),
            'posted' => $this->faker->randomElement(['yes', 'not']),
            'image' => $this->faker->imageUrl(),
            'user_id' => $this->faker->randomElement([1, 2, 3,4,5,6,7,8,9,10]),
        ];
 
    }
}
