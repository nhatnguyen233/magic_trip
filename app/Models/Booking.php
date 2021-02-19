<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'number_of_guests',
        'status',
        'date_of_booking'
    ];

    public function room()
    {
        $this->belongsTo(Room::class, 'room_id', 'id');
    }
}
