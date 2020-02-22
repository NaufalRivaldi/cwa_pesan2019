<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormPeminjamanRequest extends FormRequest
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
    public function message(){
        return [
            'required' => 'Kolom ini tidak boleh kosong!',
            'date' => 'Kolom ini harus berisikan format tanggal!'
        ];
    }

    public function rules()
    {
        return [
            'tglPengajuan' => 'required|date',
            'tglPengajuan' => 'required|array',
            'tglPengajuan.*' => 'required|date',
            'pukulA' => 'required|array',
            'pukulA.*' => 'required',
            'saranaId' => 'required|array',
            'saranaId.*' => 'required',
            'keterangan' => 'required',
            'keterangan.*' => 'required'
        ];
    }
}
