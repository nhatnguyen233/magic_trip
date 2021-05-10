<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'title',
        'description',
        'category_id',
        'country_id',
        'province_id',
        'district_id',
        'ward_id',
        'latitude',
        'longitude',
        'zipcode',
        'address',
        'avatar',
        'thumbnail'
    ];

    protected $appends = ['thumbnail_url', 'avatar_url'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(AttractionImage::class, 'attraction_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'attraction_id', 'id');
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
}
