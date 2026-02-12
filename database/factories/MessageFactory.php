<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $sender_id = User::inRandomOrder()->first()->id ;
        $receiver_id = User::inRandomOrder()->first()->id ;

        return [
            "sender_id" => $sender_id ,
            "receiver_id" => $receiver_id ,
            "content" => fake()->paragraph(),
        ];
    }
}
