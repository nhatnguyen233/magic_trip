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

    public function province()
    {
        $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function district()
    {
        $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function country()
    {
        $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function images()
    {
        $this->hasMany(AccommodationImage::class, 'accommodation_id', 'id');
    }
}
