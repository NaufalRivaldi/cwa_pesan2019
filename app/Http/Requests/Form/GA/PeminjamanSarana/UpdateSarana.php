<?php

namespace App\Http\Requests\Form\GA\PeminjamanSarana;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSarana extends FormRequest
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
            'date' => 'Masukkan format tanggal!'
        ];
    }

    public function rules()
    {
        return [
            'tgl' => 'required|date',
            'keterangan' => 'required',
            'pukulA' => 'required',
            'pukulB' => 'required',
            'saranaId' => 'required',
        ];
    }
}
