<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCustomerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:customers,email',
            'dob' => 'nullable|date',
            //'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password' => 'required',
            'password_confirmation' => 'min:6',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'nome',
            'email' => 'email',
            'dob' => 'data de nascimento',
            'password' => 'senha',
            'password_confirmation' => 'confirmação de senha',

        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Nome é um campo obrigatório',
            'email.required' => 'E-mail é um campo obrigatório',
        ];
    }
    
    /**
     * Return the error messages as json.
     *
     * @return string
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
