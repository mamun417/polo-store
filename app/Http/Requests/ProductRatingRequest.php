<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRatingRequest extends FormRequest
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
        $product_id = request('product_id');

        return [
            'product_id' => 'required|integer',
            'user_id' => ['required', 'integer',
                Rule::unique('product_ratings')->where(function ($query) use($product_id) {
                    return $query->where('product_id', $product_id);
                }),
            ],
            'rating' => 'required|integer|max:5|min:1',
        ];
    }

    public function messages()
    {
        return [
            'user_id.unique' => "Your rating already submitted!",
            'rating.required' => "Please Select Rat",
        ];
    }
}
