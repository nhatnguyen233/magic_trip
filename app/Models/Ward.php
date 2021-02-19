<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'district_id',
    ];

    public function district()
    {
        $this->belongsTo(District::class, 'district_id', 'id');
    }
}
