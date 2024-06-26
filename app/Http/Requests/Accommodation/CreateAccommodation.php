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
            'user_id' => [
                'nullable',
                'exists:users,id'
            ],
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
                'max:5120',
            ],
            'images' => [
                'nullable',
            ],
            'images.*' => [
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:5120'
            ],
            'category_id' => [
                'nullable',
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
        if(explode('/', url()->current())[3] == "admincp")
        {
            $this->merge([
                'user_id' => auth('admin')->id(),
            ]);
        } else if(explode('/', url()->current())[3] == "host")
        {
            $this->merge([
                'user_id' => auth('host')->id(),
            ]);
        }

        $this->merge([
            'slug' => Str::slug($this->name),
            'lowest_price' => doubleval(str_replace('.','',$this->lowest_price)),
        ]);
    }
}
