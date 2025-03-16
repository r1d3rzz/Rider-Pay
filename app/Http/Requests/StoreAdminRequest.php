<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAdminRequest extends FormRequest
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
            "name" => ["required", "min:3", "max:50"],
            "email" => ["required", "email", Rule::unique("admin_users", "email")],
            "phone" => ["required", "min:10", "max:13", Rule::unique("admin_users", "phone")],
            "password" => ["required", "min:8", "max:16"],
        ];
    }
}
