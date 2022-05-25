<?php

namespace App\Http\Requests\Chapter;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChapterRequest extends FormRequest
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
            'name'=> 'required|max:255',
            'description' => 'required|max:255',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Không Được để Trống Tên Chapter',
            'description.required' => 'Không Được để Trống Mô Tả Chapter',
        ];
    }
}
