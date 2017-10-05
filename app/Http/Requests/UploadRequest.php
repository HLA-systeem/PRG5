<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
        $rules = [
            'title' => 'required',
            'body' => 'required',
            'project_image' => 'image|mimes:png,jpeg|nullable|max:1999'
        ];

        $images = count($this->input('project_images'));

        foreach(range(0, $images) as $image){
            $rules[$image] = 'image|mimes:png,jpeg|nullable|max:1999';
        }

        return $rules;
    }
}
