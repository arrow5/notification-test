<?php

namespace Database\Seeders;

use App\Models\NotificationType;
use Illuminate\Database\Seeder;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NotificationType::create(['name' => 'Телеграм']);
        NotificationType::create(['name' => 'Viber']);
        NotificationType::create(['name' => 'Mail']);
    }
}
