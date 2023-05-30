<?php
namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequest;

class AuthLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function prepareForValidation()
    {
       
    }
  
}
