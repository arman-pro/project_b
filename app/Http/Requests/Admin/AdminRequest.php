<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            "name" => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'unique:admins,email,'.$this->user],
            'password' => !$this->user ? ['required', 'confirmed', 'min:6', 'max:25'] : ['nullable', 'min:6', 'max:25'] ,
            'role' => ['required'],
        ];
    }
}
