<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    static $used = [] ;


    public function definition(): array
    {
        do {

            $user_id = User::inRandomOrder()->first()->id ;
            $post_id = Post::inRandomOrder()->first()->id ;
            
        } while (isset(self::$used[$user_id. '_' . $post_id]));
        
        self::$used[] = $user_id. '_' . $post_id ;

        return [
            'user_id' => $user_id,
            'post_id' => $post_id,
        ];

    }
}
