<?php

namespace MODULES\SMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSubmitSMSRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "number"=>["required","string","regex:/09(1[0-9]|2[1-9]|3[1-9])-?[0-9]{3}-?[0-9]{4}/u"],
            "body"=>"required|string|min:5|max:1000"
        ];
    }
}
