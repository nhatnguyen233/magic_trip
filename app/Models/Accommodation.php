<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'phone',
        'lowest_price',
        'number_of_rooms',
        'status',
        'province_id',
        'district_id',
        'country_id'
    ];
}
