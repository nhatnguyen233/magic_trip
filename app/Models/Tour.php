<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'host_id',
        'name',
        'description',
        'program',
        'price',
        'discount',
        'vehicle',
        'total_time',
        'avatar',
        'thumbnail'
    ];

    protected $appends = ['thumbnail_url', 'avatar_url'];

    public function host()
    {
        return $this->belongsTo(Host::class, 'host_id', 'id');
    }

    public function infos()
    {
        return $this->hasMany(TourInfo::class, 'tour_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'tour_id', 'id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'tour_id', 'id');
    }

    public function bookTours()
    {
        return $this->hasMany(BookTour::class, 'tour_id', 'id');
    }
    
    public function getAvatarUrlAttribute()
    {
        return ($this->avatar) ? Storage::disk('s3')->url($this->avatar) : asset('img/tour_1.jpg');
    }

    public function getThumbnailUrlAttribute()
    {
        return ($this->thumbnail) ? Storage::disk('s3')->url($this->thumbnail) : asset('img/tour_1.jpg');
    }
}
