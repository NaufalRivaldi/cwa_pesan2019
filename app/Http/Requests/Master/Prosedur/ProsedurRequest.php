<?php

namespace App\Http\Requests\Master\Prosedur;

use Illuminate\Foundation\Http\FormRequest;

class ProsedurRequest extends FormRequest
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
        if (!empty('fileOld')) {
            $file = 'mimes:pdf';
        } else {
            $file = 'required|mimes:pdf';
        }
        return [
            'nama'=>'required',
            'departemenId'=>'required',
            'file'=>$file
        ];
    }

    public function messages()
    {
        return [
            'required'=>'Kolom tidak boleh kosong!',
            'mimes'=>'File harus berformat .pdf'
        ];
    }
}
