<?php

namespace App\Http\Requests\PKK\Kanidat;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'numeric' => 'Kolom ini harus numeric!'
        ];
    }
    
    public function rules(){
        return [
            'karyawanId' => 'required',
            'periodeId' => 'required',
            'poin' => 'required|numeric',
            't' => 'required|numeric',
            'ip' => 'required|numeric',
            'ik' => 'required|numeric',
            'p' => 'required|numeric'
        ];
    }
}
