<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTour extends Model
{
    use HasFactory;

    protected $table = "book_tour";
    protected $fillable = [
        'tour_id',
        'user_id',
        'payment_id',
        'quantity',
        'total_price',
        'start_time',
        'end_time',
        'status',
        'type'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }
}
