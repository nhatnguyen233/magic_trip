<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'phone',
        'room_number',
        'acreages',
        'policy',
        'number_of_bathroom',
        'number_of_kitchen',
        'checkin',
        'checkout',
        'accommodation_id'
    ];
}
