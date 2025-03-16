<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
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
        $id = $this->route("admin_user");
        return [
            "name" => ["required", "min:3", "max:50"],
            "email" => ["required", "email", Rule::unique("admin_users", "email")->ignore($id)],
            "phone" => ["required", "min:10", "max:13", Rule::unique("admin_users", "phone")->ignore($id)],
            "password" => ["nullable", "min:8", "max:16"],
        ];
    }
}
