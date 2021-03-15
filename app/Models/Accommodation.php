<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'phone',
        'address',
        'lowest_price',
        'number_of_rooms',
        'status',
        'latitude',
        'longitude',
        'ward_id',
        'province_id',
        'district_id',
        'country_id',
        'avatar',
        'thumbnail',
        'category_id'
    ];

    protected $appends = ['thumbnail_url', 'avatar_url'];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function country()
    {
        return$this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(AccommodationImage::class, 'accommodation_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'accommodation_id', 'id');
    }

    public function reviewImages()
    {
        return $this->hasManyThrough(ReviewImage::class, Review::class, 'attraction_id', 'review_id');
    }

    public function getImagesAttribute()
    {
        return $this->images()->get()->map(function ($item) {
            return Storage::disk('s3')->url($item['url']);
        });
    }

    public function getAvatarUrlAttribute()
    {
        return ($this->avatar) ? Storage::disk('s3')->url($this->avatar) : asset('img/tour_1.jpg');
    }

    public function getThumbnailUrlAttribute()
    {
        return ($this->thumbnail) ? Storage::disk('s3')->url($this->thumbnail) : asset('img/tour_1.jpg');
    }

    public function getStatusNameAttribute()
    {
        if($this->status) {
            switch ($this->status) {
                case 0:
                    $status_name = 'Chưa kích hoạt';
                break;
                case 1:
                    $status_name = 'Đã kích hoạt';
                break;
                default:
                    $status_name = 'Chưa kích hoạt';
            }

            return $status_name;
        }

        return '';
    }
}
