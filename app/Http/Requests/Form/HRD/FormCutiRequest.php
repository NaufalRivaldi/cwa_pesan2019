<?php

namespace App\Http\Requests\Form\HRD;

use Illuminate\Foundation\Http\FormRequest;

class FormCutiRequest extends FormRequest
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
    public function messages()
    {
        return [
            'required'=>'Kolom ini tidak boleh kosong!'
        ];
    }

    public function rules()
    {
        return [
            'karyawanId'=>'required',
            'idCuti'=>'required',
            'tanggalCuti'=>'required|array',
            'tanggalCuti.*' => 'required',
            'keterangan'=>'required'
        ];
    }
}
