<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'header_top_title' =>  ['required', 'string', 'max:100'],
            'description_one' => ['nullable','string', 'max:1500'],
            'description_two' => ['nullable','string', 'max:1500'],
        ];

        if (request()->isMethod('post')) {
            $rules['logo']  = 'required|mimes:jpg,jpeg,bmp,png|max:2024';
            $rules['footer_logo']  = 'required|mimes:jpg,jpeg,bmp,png|max:2024';
        }

        if (request()->isMethod('put') || request()->isMethod('patch')) {
            $rules['logo']  = 'image|mimes:jpg,jpeg,bmp,png|max:2024';
            $rules['footer_logo']  = 'image|mimes:jpg,jpeg,bmp,png|max:2024';
        }

        return $rules;
    }
}
