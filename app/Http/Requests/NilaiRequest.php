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
            'c1' => 'required',
            'c2' => 'required',
            'c3' => 'required',
            'c4' => 'required',
            // 'tinggi_tiang' => 'required',
            // 'pencahayaan' => 'required',
            // 'jarak_pandang_ideal' => 'required',
            // 'jenis_persimpangan' => 'required',
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
            'c1' => 'Tinggi tiang',
            'c2' => 'Pencahayaan',
            'c3' => 'Jarak pandang ideal',
            'c4' => 'Jenis persimpangan',
        ];
    }
}
