<?php

namespace App\Infrastructure\Controllers;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;


class SellCoinFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'coin_id'=>'required',
            'wallet_id'=>'required',
            'amount_usd'=>'required|min:0',
        ];
    }
    public function messages()
    {
        return [
            'coin_id.required' => 'El :attribute es obligatorio.',
            'wallet_id.required' => 'El :attribute es obligatorio.',
            'amount_usd.required' => 'Añade un :attribute al producto',
            'amount_usd.min' => 'El :attribute debe ser mínimo 0'
        ];
    }
    public function attributes()
    {
        return [
            'coin_id'=>'id del coin',
            'wallet_id'=>'id del wallet',
            'amount_usd'=>'candtidad de $'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, $this->errorBag);

    }
}
