<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        $id = $this->brand->id ?? null;
        return [
            'name' => 'required|string|max:255|unique:brands,name,' . $id,
            'web_url' => 'nullable|url',
            'description' => 'nullable|string',
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
            'name' => '"Brand Name"',
            'web_url' => '"Brand Url"',
            'description' => '"Description"',
        ];
    }
}
