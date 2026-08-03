<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MouvementRequest extends FormRequest
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
            'selection' => 'nullable|string',
            'formation' => 'required|string',
            'moyen' => 'required|string',
            'depart' => 'required|date|after_or_equal:2025/08/30|before_or_equal:2025/10/20',
            'nombre' => 'required|numeric',
            'effectif' => 'required|numeric',
        ];
    }
}
