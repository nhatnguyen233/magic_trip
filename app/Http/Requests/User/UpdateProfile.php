<?php

namespace App\Http\Requests\User;

use App\Enums\UserRole;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UpdateProfile extends BaseRequest
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
                'nullable',
                'exists:countries,id'
            ],
            'province_id' => [
                'nullable',
                'exists:provinces,id'
            ],
            'district_id' => [
                'nullable',
                'exists:districts,id'
            ],
            'phone' => [
                'required',
            ],
            'old_password' => [
                'nullable',
                'required_with:password',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth('customer')->user()->password)) {
                        return $fail(__('Mật khẩu cũ không đúng.'));
                    }
                },
            ],
            'password' => [
                'nullable',
                'required_with:old_password',
                'min:6'
            ],
            'email' => [
                'required',
                'email:rfc'
            ],
            'address' => [
                'nullable',
            ],
            'postal_code' => [
                'nullable',
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
