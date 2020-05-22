<?php

namespace App\Http\Requests\form\IT\PenangananIt;

use Illuminate\Foundation\Http\FormRequest;

class VerifikasiRequest extends FormRequest
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
            'max' => 'Kolom ini tidak memiliki cukup karakter',
            'min' => 'Kolom ini tidak memiliki cukup karakter'
        ];
    }
    
    public function rules()
    {
        return [
            'nik' => 'required|max:9|min:9',
            'tindakan' => 'required'
        ];
    }
}
