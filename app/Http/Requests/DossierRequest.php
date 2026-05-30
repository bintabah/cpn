<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DossierRequest extends FormRequest
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
            'date_derniere_regle' => 'required|date',
            'dure_cycle'          => 'required|integer|min:21|max:45',
            'groupe_sanguin'      => 'required|string',
            'taille_patiente'     => 'required|numeric|min:100|max:220',
            'dap'                 => 'required|numeric|min:1|max:30',
        ];
    }
}
