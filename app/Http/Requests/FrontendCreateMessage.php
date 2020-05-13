<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FrontendCreateMessage extends FormRequest
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
            'image'        => 'mimes:jpeg,png,jpg,gif|max:2048|dimensions:max_width=320,max_height=240',
            'user_name'    => 'required|string',
            'message_text' => 'required',
            'user_email'   => 'required|email'
        ];
    }
}
