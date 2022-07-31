<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NilaiRequest extends FormRequest
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
            'tinggi_tiang' => 'required',
            'pencahayaan' => 'required',
            'jarak_pandang_ideal' => 'required',
            'jenis_persimpangan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
        ];
    }

    public function attributes()
    {
        return [
            'tinggi_tiang' => 'Tinggi tiang',
            'pencahayaan' => 'Pencahayaan',
            'jarak_pandang_ideal' => 'Jarak pandang ideal',
            'jenis_persimpangan' => 'Jenis persimpangan',
        ];
    }
}
