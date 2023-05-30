<?php
namespace App\Http\Requests;

class UserStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ];
    }

    public function messages()
    {
       return [ 
        'email.required' => 'adadada'
       ];
    }

    public function prepareForValidation()
    {
       
    }
  
}
