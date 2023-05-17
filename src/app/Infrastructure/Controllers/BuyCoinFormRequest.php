<?php

namespace App\Infrastructure\Controllers;


use Illuminate\Foundation\Http\FormRequest;


class BuyCoinFormRequest extends FormRequest
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
}
