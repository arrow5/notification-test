<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('/notifications');
        $response->assertViewIs('notifications.index');
    }

    public function dataForCreate()
    {
        return [
            [
               [ 'name' => 'asdasdasdasd',
                   'inspection_period' => random_int(1,60),
                   'count_page' => random_int(1,10),
                   'idealita_active' => true,
                   'idealista_url' => 'https://www.idealista.com/uk/',
                   'olx_active' => false,
                   'olx_url' => '',
                   'fb_active' => false,
                   'fb_url' => '',
                   'notification_type_id' => 1,]
            ]
        ];
    }

    /**
     * @dataProvider dataForCreate
    */
    public function test_store($array){
        $response = $this->post('/notifications/store',$array);
        $response->dump();
    }



}
