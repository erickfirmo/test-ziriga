<?php

namespace App\Http\Requests\Customers;

class UpdateCustomerRequest extends CustomerRequest
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
            'email' => 'required|max:255|unique:customers,email,'.$this->route('user'),
            'dob' => 'nullable|date',
            //'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
        ];
    }
}
