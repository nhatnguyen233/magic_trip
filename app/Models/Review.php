<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'tour_id',
        'user_id',
        'accommodation_id',
        'room_id',
        'content',
        'email',
        'rate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ReviewImage::class, 'review_id', 'id');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
