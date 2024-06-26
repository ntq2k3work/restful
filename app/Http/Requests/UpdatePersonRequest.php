<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class UpdatePersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'FirstName' =>'min:1',
            'LastName' =>'min:1',
            'Address' =>'min:1',
            'City' =>'min:1',
        ];
    }
    public function messages()
    {
        return [
            'FirstName.min' => 'First Name must be at least 1',
            'LastName.min' => 'Last Name must be at least 1',
            'Address.min' => 'Address must be at least 1',
            'City.min' => 'City must be at least 1',
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
