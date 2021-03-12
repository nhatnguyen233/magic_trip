<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AttractionImage extends Model
{
    use HasFactory;

    protected $table = 'attraction_images';

    protected $fillable = ['user_id', 'attraction_id', 'url'];

    public function getImageUrlAttribute()
    {
        return ($this->url) ? Storage::disk('s3')->url($this->url) : asset('img/tour_1.jpg');
    }
}
