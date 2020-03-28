<?php

namespace App\Http\Requests\PKK\Kanidat;

use Illuminate\Foundation\Http\FormRequest;

class KanidatRequest extends FormRequest
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
    public function messages(){
        return [
            'required' => 'Kolom ini tidak boleh kosong!',
            'max' => 'Harus berisikan 9 karakter'
        ];
    }
    
    public function rules(){
        return [
            'nik' => 'required|max:9',
            'password' => 'required'
        ];
    }
}
