<?php

namespace App\Http\Requests\Accommodation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateAccommodation extends FormRequest
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
                'unique:accommodations,name'
            ],
            'slug' => [
                'nullable',
            ],
            'phone' => [
                'starts_with:0',
                'digits:10'
            ],
            'lowest_price' => [
                'required',
                'numeric',
            ],
            'number_of_rooms' => [
                'required',
                'numeric'
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
                'required',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:5120',
            ],
            'thumbnail' => [
                'required',
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
            'lowest_price' => doubleval(str_replace('.','',$this->lowest_price)),
        ]);
    }
}
