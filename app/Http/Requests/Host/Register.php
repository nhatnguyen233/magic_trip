<?php

namespace App\Http\Requests\Host;

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
                Rule::unique('users','email')->where('role_id', UserRole::HOST)
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
                'in:2'
            ],
            'host_name' => [
                'required',
            ],
            'date_of_establish' => [
                'required',
            ],
            'hotline' => [
                'required',
            ],
            'host_mail' => [
                'required',
                'email:rfc',
                Rule::unique('hosts','host_mail')
            ],
            'status' => [
                'nullable',
            ],
            'description' => [
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
        $this->merge([
            'role_id' => UserRole::HOST,
        ]);
    }
}
