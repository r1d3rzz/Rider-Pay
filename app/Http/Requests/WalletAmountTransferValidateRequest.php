<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletAmountTransferValidateRequest extends FormRequest
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
            "to_phone" => ["required", "min:10", "max:15"],
            "amount" => ["required", "numeric"],
            "description" => ["required", "min:3"],
        ];
    }

    public function messages()
    {
        return [
            "to_phone.required" => "The phone number is required.",
            "amount.required" => "The amount is required.",
            "description.required" => "Description is required."
        ];
    }
}
