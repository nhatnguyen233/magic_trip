<?php

namespace App\Http\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateTour extends FormRequest
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
            'user_id' => [
                'required'
            ],
            'name' => [
                'required',
            ],
            'vehicle' => [
                'nullable',
            ],
            'description' => [
                'nullable',
            ],
            'total_price' => [
                'required',
                'numeric',
            ],
            'total_time' => [
                'nullable',
                'numeric',
            ],
            'avatar' => [
                'required',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:5120',
            ],
            'thumbnail' => [
                'required',
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
        $this->merge([
            'user_id' => auth('host')->id(),
            'total_price' => doubleval($this->total_price),
        ]);
    }
}
