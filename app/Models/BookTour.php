<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookTour extends Model
{
    use HasFactory, SoftDeletes;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function bills()
    {
        return $this->hasMany(Bill::class, 'book_tour_id', 'id');
    }

    public function getStatusNameAttribute()
    {
        if(isset($this->status))
        {
            switch ($this->status)
            {
                case BookingStatus::PENDING:
                    return 'Chờ xác nhận';
                case BookingStatus::APPROVED:
                    return 'Đã chấp thuận';
                case BookingStatus::PAID:
                    return 'Đã thanh toán';
                case BookingStatus::FINISHED:
                    return 'Hoàn thành';
                case BookingStatus::CANCELED:
                    return 'Không chấp nhận';
            }
        }

        return 'Chờ xác nhận';
    }
}
