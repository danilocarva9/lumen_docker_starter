<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class FormRequest
{
    use ProvidesConvenienceMethods;

    public Request $req;

    public function __construct(Request $request, array $messages = [], array $customAttributes = [])
    {
        $this->req = $request;

        $this->prepareForValidation();

        if (!$this->authorize()) throw new UnauthorizedException;
      
        $this->validate($this->req, $this->rules(), $messages, $customAttributes);
    }

     /**
     * Throw the failed validation exception.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function throwValidationException(Request $request, $validator)
    {
        throw new HttpResponseException(
            \ApiResponse::httpCode(Response::HTTP_UNPROCESSABLE_ENTITY)->message($validator->errors()->all())->failed()
        );
    }

    public function all()
    {
        return $this->req->all();
    }

    public function get($key, $default = null)
    {   
        if(is_array($key)){
            $values = [];
            foreach($key as $value){
                $values[$value] = $this->req->get($value, $default);
            }
            return $values;
        }
        return $this->req->get($key, $default);
    }

    public function add($key, $default = null)
    {
       $request = $this->req->all();
       $request[$key] = $default;
       return $request;
    }

    protected function prepareForValidation()
    {
        //
    }

    protected function authorize()
    {
        return true;
    }

    protected function rules()
    {
        return [];
    }
}