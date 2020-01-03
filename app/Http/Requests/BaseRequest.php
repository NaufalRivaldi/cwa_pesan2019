<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
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
            'required' => 'Kolom tidak boleh kosong.'
        ];
    }

    public function rules()
    {
        return [
            'productId' => 'required',
            'name' => 'required|array',
            'name.*' => 'required'
        ];
    }
}
