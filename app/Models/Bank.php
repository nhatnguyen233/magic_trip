<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'bank_short_name',
        'bank_code'
    ];

    public function host()
    {
        return $this->hasMany(Host::class, 'bank_id', 'id');
    }
}
