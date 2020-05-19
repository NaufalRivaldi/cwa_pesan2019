<?php

namespace App\Http\Requests\Master\MasterFile;

use Illuminate\Foundation\Http\FormRequest;

class MasterFileRequest extends FormRequest
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
            'nama'=>'required',
            'dep'=>'required',
            'kategori'=>'required',
            'no_form'=>'required',
            'no_revisi'=>'required',
            'tgl_terbit'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'required'=>'Kolom ini tidak boleh kosong!'
        ];
    }
}
