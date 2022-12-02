<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'title'=>'required|min:3|max:10','body'=>'required|min:3|max:12',
            'image'=> $this->route('slug') ? 'image|mimes:png,jpeg|max:2048':'required|image|mimes:png,jpeg|max:2048'
        ];
    }
}
