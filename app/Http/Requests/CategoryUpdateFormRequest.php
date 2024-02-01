<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateFormRequest extends FormRequest
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
            'id'        => ['required', 'numeric'],
            'name'      => [
                'required',
                Rule::unique('category', 'name')
                    ->where(function ($query) {
                        return $query
                            ->where('name', $this->input('name'))
                            ->whereNull('deleted_at');
                    })
                    ->ignore($this->id),
            ],
            'parent_id' => ['required'],
            'image'     => ['required_if:has_exist,1', 'mimes:jpg,png,jpeg'],
        ];
    }

    public function messages()
    {
        return [
            'id.required'          => "Category id must be required.",
            'id.numeric'           => "Id must be numeric.",
            'name.required'        => 'Please fill in the Category name.',
            'name.unique'          => 'Category name is already taken, please choose another name.',
            'parent_id.required'   => 'Please choose a category.',
            'image.required_if'    => 'Please choose an image.',
            'image.mimes'          => 'The image must be a file of type: jpg, png, jpeg.',
        ];
    }

}