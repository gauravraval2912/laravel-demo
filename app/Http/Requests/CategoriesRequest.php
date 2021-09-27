<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
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
        $rules = null;

        $rules = [
            'name'     => 'required',
            'email'    => 'required|email',
        ];

        if ($this->has('addform')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }

        if(!empty($this->hasFile('image'))){
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }

        return $rules;
    }
}
