<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'host_id', 'book_tour_id', 'total_price'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function bookTour()
    {
        return $this->belongsTo(BookTour::class, 'book_tour_id', 'id');
    }
}
