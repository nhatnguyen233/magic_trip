<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['tour_id', 'departure_time', 'number_max_slots'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }
}
