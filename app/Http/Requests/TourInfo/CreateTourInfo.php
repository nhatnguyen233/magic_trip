<?php

namespace App\Http\Requests\TourInfo;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateTourInfo extends FormRequest
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
            'tour_id' => [
                'required'
            ],
            'attraction_id' => [
                'required',
            ],
            'accommodation_id' => [
                'required',
            ],
            'title' => [
                'nullable',
            ],
            'start_time' => [
                'nullable',
                'date_format:H:i',
            ],
            'limit_time' => [
                'nullable',
            ],
            'vehicle' => [
                'nullable',
            ],
            'vehicle_info' => [
                'nullable',
            ],
            'order_number' => [
                'nullable',
                Rule::unique('tour_infos', 'order_number')->where('tour_id', $this->tour_id)
            ],
            'summary' => [
                'nullable',
            ],
            'thumbnail' => [
                'nullable',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:5120',
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
        if($this->vehicle_info)
        {
            $this->merge([
                'vehicle' => $this->vehicle_info,
            ]);
        }
    }
}
