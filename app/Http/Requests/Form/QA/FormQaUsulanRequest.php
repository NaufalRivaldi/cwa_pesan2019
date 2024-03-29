<?php

namespace App\Http\Requests\Form\QA;

use Illuminate\Foundation\Http\FormRequest;

class FormQaUsulanRequest extends FormRequest
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
            'required'=>'Kolom ini tidak boleh kosong!',
        ];
    }

    public function messages()
    {
        return [
            'karyawanId'=>'required',
            'kategori'=>'required',
            'dokumenId'=>'required',
            'qty'=>'required'
        ];
    }
}
