<?php

namespace App\Models;

use App\Enums\BookingStatus;
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
        'number_of_slots',
        'total_price',
        'date_of_book',
        'status',
        'type'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }

    public function getStatusNameAttribute()
    {
        if(isset($this->status))
        {
            switch ($this->status)
            {
                case BookingStatus::PENDING:
                    return 'Chờ xác nhận';
                case BookingStatus::PAID:
                    return 'Đã thanh toán';
                case BookingStatus::FINISHED:
                    return 'Hoàn thành';
                case BookingStatus::CANCELED:
                    return 'Đã hủy bỏ';
            }
        }

        return 'Chờ xác nhận';
    }
}
