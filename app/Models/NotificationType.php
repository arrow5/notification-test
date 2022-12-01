<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    use HasFactory;

    const TYPE_TELEGRAM = 1;
    const TYPE_VIBER = 2;
    const TYPE_MAIL = 3;



    protected $fillable = ['name'];
}
