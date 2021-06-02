<?php

namespace App\Http\Requests\Tour;

use DateTime;
use Illuminate\Foundation\Http\FormRequest;

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
            'address' => [
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
            'dates' => [
                'nullable'
            ],
            'description' => [
                'nullable'
            ],
            'province_id' => [
                'nullable',
                'exists:provinces,id'
            ],
            'cat_id' => [
                'nullable',
                'exists:categories,id'
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
        if($this->dates != null)
        {
            $start_date = DateTime::createFromFormat('d-m-Y', explode(" > ", $this->dates)[0]);
            $end_date = DateTime::createFromFormat('d-m-Y', explode(" > ", $this->dates)[1]);
            $this->merge([
                'start_time' => $start_date->format('Y-m-d'),
                'end_time' => $end_date->format('Y-m-d')
            ]);
        }
    }
}
