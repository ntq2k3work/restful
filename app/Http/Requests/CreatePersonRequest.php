<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CreatePersonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'FirstName' =>'required|min:1',
            'LastName' =>'required|min:1',
            'Address' =>'required|min:1',
            'City' =>'required|min:1',
        ];
    }
    public function messages()
    {
        return [
            'FirstName.required' => 'First Name is required',
            'LastName.required' => 'Last Name is required',
            'Address.required' => 'Address is required',
            'City.required' => 'City is required'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $response = new Response([
            'errors' => $validator->errors()
        ], Response::HTTP_UNPROCESSABLE_ENTITY);

        throw (new ValidationException($validator,$response));

    }
}
