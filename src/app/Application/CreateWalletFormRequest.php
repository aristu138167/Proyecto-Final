<?php

namespace App\Application;


use Illuminate\Foundation\Http\FormRequest;


class CreateWalletFormRequest extends FormRequest
{
    protected  $redirectRoute='post.create';
    public function rules()
    {
        return [
            'user_id' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'user_id' => 'id del usuario',
        ];
    }
}
