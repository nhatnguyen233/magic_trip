<?php

namespace App\Http\Requests\Schedule;

use App\Repositories\Schedule\ScheduleRepository;
use DateTime;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateSchedule extends FormRequest
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
                Rule::exists('tours', 'id'),
                function ($attribute, $value, $fail) {
                    if (isset($value) && isset($this->departure_time)) {
                        if ($this->scheduleRepository->checkScheduleExists($value, $this->departure_time)) {
                            $fail('Lịch này đã được đăng ký, vui lòng cập nhật lại hoặc xóa lịch này trước khi tạo mới');
                        }
                    }
                },
            ],
            'departure_time' => [
                'required',
                'after_or_equal:today'
            ],
            'number_max_slots' => [
                'required',
                'min:0',
                'numeric'
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
        if($this->departure_time != null)
        {
            $date = DateTime::createFromFormat('d-m-Y', $this->departure_time);
            $this->merge([
                'departure_time' => $date->format('Y-m-d')
            ]);
        }
    }
}
