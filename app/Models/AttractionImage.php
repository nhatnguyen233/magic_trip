<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttractionImage extends Model
{
    use HasFactory;

    protected $table = 'attraction_images';

    protected $fillable = ['attraction_id', 'url'];
}
