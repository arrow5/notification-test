<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'inspection_period',
        'count_page',
        'idealita_active',
        'idealista_url',
        'olx_active',
        'olx_url',
        'fb_active',
        'fb_url',
        'notification_type_id',
    ];

    public function notificationType()
    {
        return $this->hasOne(NotificationType::class);
    }
}
