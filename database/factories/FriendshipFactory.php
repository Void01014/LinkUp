<?php

namespace Database\Factories;

use App\Models\Friendship;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User ;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Friendship>
 */
class FriendshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Friendship::class ;

    public function definition(): array
    {


        $reseaver = User::inRandomOrder()->first()->id ;
        $sender = User::inRandomOrder()->first()->id ;

        while($reseaver === $sender){
            $reseaver = User::inRandomOrder()->first()->id ;
        }


        return [
            'user_id' => $sender ,
            'friend_id' => $reseaver ,
            'status' => fake()->randomElement(['pending', 'accepted', 'rejected'])
        ];
    }

}
