<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'thumb' => 'required|max:255',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Không Được để Trống Tên Danh Mục',
            'description.required' => 'Không Được để Trống Mô Tả Danh Mục',
            'thumb.required' => 'Không Được để Trống Hình Ảnh'
        ];
    }
}
