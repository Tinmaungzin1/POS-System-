<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'name'          => [
                'required',
                Rule::unique('item', 'name')->where(function($query){
                    return $query
                    ->where('name', $this->name)
                    ->whereNull('deleted_at');
                })->ignore($this->id),
            ],
            'category_id'   => ['required'],
            'price'         => ['required'],
            'quantity'      => ['required'],
            'image'         => ['required_if:has_exist,1', 'mimes:jpg,png,jpeg']
        ];
    }
    public function messages() {
        return [
            'name.required'         => 'Please fill item name',
            'name.unique'           => 'Item name is alerady exist,choose  other name',
            'category_id.required'  => 'Please choose category',
            'price.required'        => 'Please fill item price',
            'quantity.required'     => 'Please fill quantity',
            'image.required'        => 'Please choosse Image',
        ];
    }
}