<?php

namespace App\Http\Requests\Bill;

use DateTime;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class GetList extends FormRequest
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
            'username' => [
                'nullable',
            ],
            'start_time' => [
                'nullable',
            ],
            'end_time' => [
                'nullable',
                'required_with:start_time',
                'after_or_equal:start_time'
            ],
            'created_at' => [
                'nullable'
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
        if($this->created_at != null)
        {
            $start_date = DateTime::createFromFormat('d-m-Y', explode(" > ", $this->created_at)[0]);
            $end_date = DateTime::createFromFormat('d-m-Y', explode(" > ", $this->created_at)[1]);
            $this->merge([
                'start_time' => $start_date->format('Y-m-d'),
                'end_time' => $end_date->format('Y-m-d')
            ]);
        }
    }
}
