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
        return [
            'nama'=>'required',
            'departemenId'=>'required',
            'file'=>'required|mimetypes:application/pdf'
        ];
    }

    public function messages()
    {
        return [
            'required'=>'Kolom tidak boleh kosong!',
            'mimetypes'=>'File harus berformat .pdf'
        ];
    }
}
