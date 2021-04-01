<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class CreateReview extends FormRequest
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
            'customer_name' => [
                'nullable',
                'unique:attractions,name'
            ],
            'user_id' => [
                'nullable',
                'exists:users,id'
            ],
            'tour_id' => [
                'nullable',
                'exists:tours,id'
            ],
            'accommodation_id' => [
                'nullable',
                'exists:accommodations,id'
            ],
            'content' => [
                'nullable',
            ],
            'email' => [
                'nullable',
                'email:rfc'
            ],
            'rate' => [
                'required',
                'min:1',
                'max:10'
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
        if(auth('customer')->check()) {
            $this->merge([
                'user_id' => auth('customer')->id()
            ]);
        }
    }
}
