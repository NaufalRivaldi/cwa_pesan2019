<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KaryawanRequest extends FormRequest
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
            'required' => 'Kolom ini tidak boleh kosong!'
        ];
    }
    
     public function rules()
    {
        return [
            'nik' => 'required',
            'nama' => 'required',
            'dep' => 'required',
            'stat' => 'required'
        ];
    }
}
