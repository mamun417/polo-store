<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $id = $this->product->id ?? null;

        $rules = [
            'category' => 'required|numeric',
            'brand' => 'required|numeric',
            'tax' => 'nullable|numeric',
            'product_name' => 'required|string|max:255|unique:products,name,' . $id,
            'product_code' => 'required|string|max:255',
            'product_size_arr' => 'required_without:product_price|array',
            'product_size_arr.*' => 'required_without:product_price',
            'product_price_arr' => 'required_without:product_price|array',
            'product_price_arr.*' => 'required_without:product_price',
            'discount_price_arr.*' => 'nullable|numeric|lt:product_price_arr.*',
            'product_stock_arr' => 'required_without:product_price|array',
            'product_stock_arr.*' => 'required_without:product_price',
            'product_color_arr' => 'required|array|max:255',
            'product_price' => 'nullable|numeric',
            'product_quantity' => 'nullable|numeric|required_with:product_price',
            'product_details' => 'nullable|string',
            'product_img' => 'nullable|array',
        ];

        if (request('product_price')) {
            $rules['product_discount_price'] = 'nullable|numeric|lt:product_price';
        }


//        if (request()->isMethod('post')) {
//            $rules['product_img'] = 'required|array|min:1';
//        }
//
//        if (request()->isMethod('put') || request()->isMethod('patch')) {
//            $rules['product_img'] = '||min:1|max:3';
//        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'product_size_arr.*' => 'product size',
            'product_price_arr.*' => 'product price',
            'product_stock_arr.*' => 'product stock',
            'discount_price_arr.*' => 'product discount price',
        ];
    }
}
