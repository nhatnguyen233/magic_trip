<?php

namespace App\Http\Requests\Cart;

use App\Repositories\Schedule\ScheduleRepository;
use DateTime;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class CreateCart extends FormRequest
{
    protected $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepository, array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        $this->scheduleRepository = $scheduleRepository;
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'session_token' => [
                'required',
            ],
            'tour_name' => [
                'required',
            ],
            'tour_id' => [
                'required',
                'exists:tours,id',
                function ($attribute, $value, $fail) {
                    if (isset($value) && isset($this->date_of_book) && isset($this->number_of_slots)) {
                        if ($this->scheduleRepository->checkScheduleFullSlot($value, $this->date_of_book, $this->number_of_slots)) {
                            $fail('Ngày này đã được đặt hết hoặc không tồn tại!');
                        }
                    }
                },
            ],
            'price' => [
                'required',
                'numeric'
            ],
            'number_of_slots' => [
                'required',
                'numeric'
            ],
            'discount' => [
                'nullable',
            ],
            'thumbnail' => [
                'nullable',
            ],
            'dates' => [
                'required',
            ],
            'date_of_book' => [
                'required',
                'after_or_equal:today'
            ],
            'expired_at' => [
                'required',
                'after_or_equal:today'
            ],
            'total_price' => [
                'nullable',
            ]
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if($this->tour_id != null)
        {
            $this->merge([
                'tour_id' => intval($this->tour_id),
            ]);
        }

        if($this->price != null || $this->price >= 0)
        {
            $this->merge([
                'price' => doubleval($this->price),
            ]);
        }

        if($this->number_of_slots != null || $this->number_of_slots >= 0)
        {
            $this->merge([
                'number_of_slots' => intval($this->number_of_slots),
            ]);
        }

        if($this->date_of_book != null)
        {
            $date = DateTime::createFromFormat('d-m-Y', $this->date_of_book);
            $this->merge([
                'date_of_book' => $date->format('Y-m-d')
            ]);
        }

        $this->merge([
            'session_token' => session()->get('session_token'),
            'total_price' => $this->number_of_slots*$this->price,
            'expired_at' => Carbon::now()->addWeeks(1),
        ]);
    }
}
