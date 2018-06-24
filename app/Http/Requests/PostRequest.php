<?php

namespace App\Http\Requests;

class PostRequest extends Request
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
            'title' => 'required',
            //'category_id' => 'required',
            'photo_id' => 'required',
            'body' => 'required'
        ];
    }

    public function messages()
    {
        return
            [
                'category_id.required' => 'The category field is required.',
                'photo_id.required' => 'The photo field is required.'
            ];
    }

}
