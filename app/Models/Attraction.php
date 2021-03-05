<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    use HasFactory;

    public function category()
    {
        $this->belongsTo(CategoryAttraction::class, 'category_id', 'id');
    }

    public function country()
    {
        $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function province()
    {
        $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function district()
    {
        $this->belongsTo(District::class, 'district_id', 'id');
    }
}
