<?php

namespace Database\Factories;

use App\Models\NotificationType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::first()->id,
            'name' => $this->faker->text(10),
            'inspection_period' => random_int(1,60),
            'count_page' => random_int(1,10),
            'idealita_active' => $this->faker->boolean,
            'idealista_url' => $this->faker->url,
            'olx_active' => $this->faker->boolean,
            'olx_url' => $this->faker->url,
            'fb_active' => $this->faker->boolean,
            'fb_url' => $this->faker->url,
            'notification_type_id' => NotificationType::inRandomOrder()->first()->id,
        ];
    }
}
