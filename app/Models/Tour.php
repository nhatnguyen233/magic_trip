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
        'name',
        'description',
        'total_price',
        'vehicle',
        'total_time',
        'avatar',
        'thumbnail'
    ];

    protected $appends = ['thumbnail_url', 'avatar_url'];

    public function infos()
    {
        return $this->hasMany(TourInfo::class, 'tour_id', 'id');
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
