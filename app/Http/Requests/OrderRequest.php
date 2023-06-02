<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'job_type' => ['required', 'string', 'max: 60'],
            'image_qty' => ['required', 'numeric', 'min:1'],
            'delivery_date' => ['required', 'date'],
            'image_destination' => ['required', 'url', 'max:255'],
            'job_description' => ['required', 'string'],
            'gallery' => ['nullable', 'max:5', 'array'],
        ];
    }
}
