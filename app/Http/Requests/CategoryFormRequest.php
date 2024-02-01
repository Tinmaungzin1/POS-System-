<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'          => [
                'required',
                Rule::unique('category', 'name')->where(function($query){
                    return $query
                    ->where('name', $this->name)
                    ->whereNull('deleted_at');
                }),
            ],
            'parent_id'     => 'required',
            'image'         => 'required|mimes:jpg,png,jpeg',
        ];
    }

    public function message() {
        return [
            'name.required'         => 'Please fill category name',
            'name.unique'           => 'Category name is already exist,choose other name.',
            'parent_id.required'    => 'Please choose category',
            'image.required'        => 'Please choose category image',
            'image.mimes'           => 'The image must be a file of type: jpg, png, jpeg',
        ];
    }
}