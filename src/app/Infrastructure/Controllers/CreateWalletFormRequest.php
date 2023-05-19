<?php

namespace App\Infrastructure\Controllers;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;


class CreateWalletFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'El :attribute es obligatorio.',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => 'id del usuario',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, $this->errorBag);

    }
}
