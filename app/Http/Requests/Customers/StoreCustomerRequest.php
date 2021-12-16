<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class StoreCustomerRequest extends FormRequest
{

    protected $forceJsonResponse = true;

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
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
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
            // name
            'name.required' => 'O nome é obrigatório.',
            'name.max' => 'O nome deve ter no máximo :max caracteres.',
            'name.min' => 'O nome deve ter no mínimo :min caracteres.',
            // email
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail é inválido.',
            'email.max' => 'O e-mail deve ter no máximo :max caracteres.',
            'email.min' => 'O e-mail deve ter no mínimo :min caracteres.',
            'email.unique' => 'O e-mail já está em uso.',
            // dob
            'dob.date' => 'A data de nascimento não é uma data válida.',
            // password
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'O e-mail deve ter no mínimo :min caracteres.',
            'password.confirmed' => 'A confirmação de senha não corresponde.',
            'password_confirmation.required' => 'A confirmação de senha é obrigatória.',
            'password_confirmation.min' => 'A confirmação de senha deve ter no mínimo :min caracteres.',
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
