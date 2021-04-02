<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class CreatePayment extends FormRequest
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
            'card_name' => [
                'nullable'
            ],
            'card_number' => [
                'required',
                'digits:16'
            ],
            'expire_month' => [
                'required',
                'size:2',
                'max:12'
            ],
            'expire_year' => [
                'required',
                'size:2',
                'max:99'
            ],
            'security_code' => [
                'required',
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

    }
}
