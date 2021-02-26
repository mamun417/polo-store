<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
        $rules = [
            'title' => 'nullable|string|max:255',
            'amount' => 'required|numeric',
            'start_at' => 'required|date',
            'expire_at' => 'required|date',
            'type' => 'required|numeric',
        ];

        if (!$this->offer) {
            $rules['product_id'] = 'required';
        }

        return $rules;
    }
}
