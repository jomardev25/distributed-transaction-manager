<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class RollbackTransactionRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "account_num" => "required"
        ];
    }

    public function filters()
    {
        return [
            "account_num" =>  "trim|escape|cast:int"
        ];
    }
}
