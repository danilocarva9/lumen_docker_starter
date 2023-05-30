<?php
namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequest;

class RecoveryPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'required|confirmed',
            'recoveryHash' => 'required'
        ];
    }

    public function prepareForValidation()
    {
       
    }
  
}
