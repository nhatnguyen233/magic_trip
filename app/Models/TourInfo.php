<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TourInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'attraction_id',
        'accommodation_id',
        'title',
        'vehicle',
        'summary',
        'start_time',
        'limit_time',
        'order_number',
        'thumbnail'
    ];

    protected $appends = ['thumbnail_url',];

    public function attraction()
    {
        return $this->belongsTo(Attraction::class, 'attraction_id', 'id');
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class, 'accommodation_id', 'id');
    }

    public function getThumbnailUrlAttribute()
    {
        return ($this->thumbnail) ? Storage::disk('s3')->url($this->thumbnail) : asset('img/tour_1.jpg');
    }
}
