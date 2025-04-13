<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddUserWalletAmountRequest extends FormRequest
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
            "user_id" => ["required", Rule::exists("users", "id")],
            "amount" => ["required", "min:1000", "integer"],
            "description" => ["required", "min:6"]
        ];
    }

    public function messages()
    {
        return [
            "user_id.required" => "Username is required.",
            "amount.required" => "Wallet Amount is required.",
            "description.required" => "Description is required.",
        ];
    }
}
