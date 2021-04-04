<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class CreateCart extends FormRequest
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
            'session_token' => [
                'required',
            ],
            'tour_name' => [
                'required',
            ],
            'tour_id' => [
                'required',
                'exists:tours,id'
            ],
            'price' => [
                'required',
                'numeric'
            ],
            'quantity' => [
                'required',
                'numeric'
            ],
            'discount' => [
                'nullable',
            ],
            'thumbnail' => [
                'nullable',
            ],
            'dates' => [
                'required',
            ],
            'start_time' => [
                'required',
                'after_or_equal:today'
            ],
            'end_time' => [
                'required',
                'after_or_equal:start_time'
            ],
            'expired_at' => [
                'required',
                'after_or_equal:today'
            ],
            'total_price' => [
                'nullable',
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
        if($this->tour_id != null)
        {
            $this->merge([
                'tour_id' => intval($this->tour_id),
            ]);
        }

        if($this->price != null || $this->price >= 0)
        {
            $this->merge([
                'price' => doubleval($this->price),
            ]);
        }

        if($this->quantity != null || $this->price >= 0)
        {
            $this->merge([
                'quantity' => intval($this->quantity),
            ]);
        }

        $this->merge([
            'session_token' => session()->get('session_token'),
            'start_time' => date("Y-m-d", strtotime(explode(" ", $this->dates)[0])),
            'end_time' => date("Y-m-d", strtotime(explode(" ", $this->dates)[2])),
            'total_price' => $this->quantity*$this->price,
            'expired_at' => Carbon::now()->addWeeks(1),
        ]);
    }
}
