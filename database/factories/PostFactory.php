<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User ;

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

    protected $model = Post::class ;
    
    public function definition(): array
    {
        $user_id = User::inRandomOrder()->first()->id ;

        return [
            'user_id' => $user_id ,
            'content' => fake()->paragraph() 
        ];
    }
}
