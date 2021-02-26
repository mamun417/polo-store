<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingMethodRequest extends FormRequest
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
        $id = $this->shipping_method->id ?? null;
        return [
            'title' => 'required|string|max:255|unique:shipping_methods,title,' . $id,
            'applicable_amount' => 'required|integer',
            'charge' => 'required|integer',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => '"Title"',
            'applicable_amount' => '"Applicable Amount"',
            'charge' => '"Shipping Charge"',
        ];
    }
}
