<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Comment::class ;


    public function definition(): array
    {
        $user_id = User::inRandomOrder()->first()->id ;
        $post_id = Post::inRandomOrder()->first()->id ;
        
        return [
            "user_id" => $user_id ,
            "post_id" => $post_id ,
            "content" => fake()->paragraph()  
        ];
    }
}
