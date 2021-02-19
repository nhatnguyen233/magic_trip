<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'province_id',
    ];

    public function province()
    {
        $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function wards()
    {
        $this->hasMany(Ward::class, 'district_id', 'id');
    }
}
