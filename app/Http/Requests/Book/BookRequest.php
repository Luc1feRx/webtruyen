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
            'description' => 'required|max:255',
            'author' => 'required|max:255',
            'summary' => 'required|max:255|min:3'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Không Được để Trống Tên Danh Mục',
            'author.required' => 'Không Được để Trống Tên Tác Giả',
            'description.required' => 'Không Được để Trống Mô Tả Danh Mục',
            'summary.required' => 'Không Được để Trống Tóm Tắt Truyện'
        ];
    }
}
