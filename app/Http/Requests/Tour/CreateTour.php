<?php

namespace App\Http\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;

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
            'host_id' => [
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
            'program' => [
                'nullable',
            ],
            'price' => [
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
            'host_id' => auth('host')->user()->host->id,
            'price' => doubleval(str_replace('.','',$this->price)),
        ]);
    }
}
