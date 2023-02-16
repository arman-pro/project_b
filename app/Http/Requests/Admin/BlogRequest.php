<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title'             => ['required', 'string', 'max:255', 'unique:blogs,title,'.optional($this->blog)->id],
            'categories'        => ['required', 'array', 'min:1'],
            'image'             => ['nullable', "mimes:jpg,bmp,png,JPEG,PNG,JPG", 'max:400'],
            'short_description' => ['required'],
            'description'       => ['nullable'],
            'meta_title'        => ["nullable"],
            'meta_description'  => ["nullable"],
            'meta_keyword'      => ["nullable"],
            'img_alt_text'      => ["nullable"],
            'meta_robot_tags'   => ["nullable"],
            'status'            => ["required"],
        ];
    }
}
