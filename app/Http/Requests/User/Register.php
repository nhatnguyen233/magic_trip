<?php

namespace App\Http\Requests\User;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Register extends FormRequest
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
                'required'
            ],
            'country_id' => [
                'required',
                'exists:countries,id'
            ],
            'province_id' => [
                'required',
                'exists:provinces,id'
            ],
            'district_id' => [
                'nullable',
                'exists:districts,id'
            ],
            'phone' => [
                'required',
            ],
            'password' => [
                'required',
                'confirmed',
                'min:6'
            ],
            'email' => [
                'required',
                'email:rfc',
                Rule::unique('users','email')->where('role_id', UserRole::CUSTOMER)
            ],
            'password_confirmation' => [
                'required_with:password',
                'same:password',
            ],
            'address' => [
                'nullable',
            ],
            'postal_code' => [
                'required',
            ],
            'avatar' => [
                'nullable',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:5120',
            ],
            'role_id' => [
                'required',
                'in:1'
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
            'role_id' => UserRole::CUSTOMER
        ]);
    }
}
