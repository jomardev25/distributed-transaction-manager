<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class CreateTransactionRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "first_name" => "required",
            "last_name" => "required",
            "balance" => "required",
        ];
    }

    public function filters()
    {
        return [
            "first_name" =>  "trim|escape",
            "last_name" =>  "trim|escape",
            "balance" =>  "trim|escape"
        ];
    }
}
