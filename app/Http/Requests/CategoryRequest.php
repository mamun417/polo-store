<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $id = $this->category->id ?? null;

        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'parent_id' => 'nullable|numeric',
            'description' => 'nullable|string',
        ];
    }
}
