<?php

namespace App\Http\Requests\Admin\Attraction;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateAttraction extends FormRequest
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
            'name' => [
                'required',
            ],
            'title' => [
                'required',
            ],
            'slug' => [
                'nullable',
            ],
            'category_id' => [
                'nullable',
            ],
            'country_id' => [
                'nullable',
            ],
            'province_id' => [
                'nullable',
            ],
            'district_id' => [
                'nullable',
            ],
            'ward_id' => [
                'nullable',
            ],
            'zipcode' => [
                'nullable',
                'digits:6',
            ],
            'latitude' => [
                'nullable',
                'required_with:longitude',
            ],
            'longitude' => [
                'nullable',
                'required_with:latitude',
            ],
            'description' => [
                'nullable',
            ],
            'address' => [
                'nullable',
            ],
            'avatar' => [
                'nullable',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:5120',
            ],
            'thumbnail' => [
                'nullable',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:5120',
            ],
            'images' => [
                'nullable',
            ],
            'images.*' => [
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:5120'
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
        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }
}
