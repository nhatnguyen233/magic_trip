<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'accommodation_id',
        'room_id',
        'content',
        'rate'
    ];

    public function images()
    {
        return $this->hasMany(ReviewImage::class, 'review_id', 'id');
    }
}
