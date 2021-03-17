<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'total_price',
        'vehicle',
        'total_time'
    ];

    public function infos()
    {
        return $this->hasMany(TourInfo::class, 'tour_id', 'id');
    }
}
