<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_token',
        'tour_id',
        'tour_name',
        'price',
        'discount',
        'quantity',
        'total_price',
        'thumbnail',
        'start_time',
        'payment_id',
        'end_time',
        'expired_at'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }

    public function getThumbnailUrlAttribute()
    {
        return ($this->thumbnail) ? Storage::disk('s3')->url($this->thumbnail) : asset('img/tour_1.jpg');
    }
}
