<?php

namespace App\Http\Requests\Schedule;

use DateTime;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSchedule extends FormRequest
{
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
            'departure_time' => [
                'nullable',
                'after_or_equal:today',
            ],
            'number_max_slots' => [
                'nullable',
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
        if($this->departure_time != null) {
            $date = DateTime::createFromFormat('d-m-Y', $this->departure_time);
            $this->merge([
                'departure_time' => $date->format('Y-m-d')
            ]);
        }
    }
}
