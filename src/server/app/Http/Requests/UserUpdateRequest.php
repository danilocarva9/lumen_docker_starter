<?php
namespace App\Http\Requests;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|int',
            'name' => 'required|string',
            'role' => 'required|string',
            'description' => 'required|min:3|max:1000',
            'picture' => 'sometimes|required|mimes:png,jpg,jpeg|max:2048'
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
