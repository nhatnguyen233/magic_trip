<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Host extends Model
{
    use HasFactory;

    protected $fillable = [
        'host_name',
        'host_mail',
        'hotline',
        'description',
        'user_id',
        'country_id',
        'bank_id',
        'date_of_establish',
        'thumbnail',
        'avatar',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }

    public function bookings()
    {
        return $this->hasManyThrough(BookTour::class, Tour::class, 'host_id', 'tour_id');
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
