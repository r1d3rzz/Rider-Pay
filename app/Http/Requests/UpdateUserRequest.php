<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $id = $this->route("user");
        return [
            "name" => ["required", "min:3", "max:50"],
            "email" => ["required", "email", Rule::unique("users", "email")->ignore($id)],
            "phone" => ["required", "min:10", "max:13", Rule::unique("users", "phone")->ignore($id)],
            "password" => ["nullable", "min:8", "max:16"],
        ];
    }
}
