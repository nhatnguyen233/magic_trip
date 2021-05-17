<?php

namespace App\Http\Requests\TourInfo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTourInfo extends FormRequest
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
                'nullable',
            ],
            'start_time' => [
                'nullable',
            ],
            'limit_time' => [
                'nullable',
            ],
            'vehicle' => [
                'nullable',
            ],
            'order_number' => [
                'nullable',
            ],
        ];
    }
}
