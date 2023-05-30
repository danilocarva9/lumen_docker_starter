<?php
namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email'
        ];
    }

    public function prepareForValidation()
    {
       
    }
  
}
