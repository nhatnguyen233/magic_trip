<?php

namespace App\Http\Requests\BookTour;

use App\Repositories\Schedule\ScheduleRepository;
use DateTime;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class Approve extends FormRequest
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
            'tour_id' => [
                'required',
                'exists:tours,id',
                function ($attribute, $value, $fail) {
                    if (isset($value) && isset($this->date_of_book) && isset($this->number_of_slots)) {
                        if ($this->scheduleRepository->checkScheduleFullSlot($value, $this->date_of_book, $this->number_of_slots)) {
                            $fail('Ngày này đã được đặt hết');
                        }
                    }
                },
            ],
            'number_of_slots' => [
                'required',
                'numeric'
            ],
            'date_of_book' => [
                'required',
                'after_or_equal:today'
            ],
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

        if($this->number_of_slots != null || $this->number_of_slots >= 0)
        {
            $this->merge([
                'number_of_slots' => intval($this->number_of_slots),
            ]);
        }
    }
}
