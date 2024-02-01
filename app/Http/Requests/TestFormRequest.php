<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TestFormRequest extends FormRequest
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
                'company_name' => [
                    'required',
                    Rule::unique('setting')->where(function($query){
                        return $query
                            ->where('company_name', $this->company_name)
                            ->whereNull('deleted_at');
                    })
                ],
                'company_phone' => [
                    'required'
                ],
                'company_email' => [
                    'required',
                    'email',
                    Rule::unique('setting')->where(function($query){
                        return $query
                        ->where('company_name', $this->company_name)
                        ->whereNull('deleted_at');
                    })

                ],
                'company_address' => [
                    'required'
                ]
        ];
    }
    public function messages() {
        return [
            'company_name.required'     => 'Please fill company name',
            'company_name.unique'       => 'Company name is already exist',
            'company_phone.required'    => 'Please fill company phone number',
            'company_email.required'    => 'Please ill company email',
            'company_email.unique'      => 'Company email is already exist',
            'company_email.email'       => 'Email format is wrond',
            'company_address.required'  => 'Please fill company address',
        ];
    }
}
