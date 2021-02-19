<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_id',
    ];

    public function country()
    {
        $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function districts()
    {
        $this->hasMany(District::class, 'province_id', 'id');
    }
}
