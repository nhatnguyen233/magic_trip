<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class EventRequest extends FormRequest
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
            'title' => [
                'required',
                'unique:accommodations,name'
            ],
            'description' => [
                'nullable',
            ],
            'author' => [
                'starts_with:0',
                'digits:10'
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
    }
}
