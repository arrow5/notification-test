<?php

namespace Database\Seeders;

use App\Models\Notification;
use Database\Factories\NotificationFactory;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::factory()->count(100)->create();
    }
}
