<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TurmaRequest extends Request
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
        switch ($this->method()) {
            case 'POST': {
                return [
                    'serie' => 'required|max:10',
                    'turno' => 'required',
                    'ensino' => 'required',
                    'letraTurma' => 'required|max:2',
                    'ano' => 'required|digits:4'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'serie' => 'required|max:10',
                    'turno' => 'required',
                    'ensino' => 'required',
                    'letraTurma' => 'required|max:2',
                    'ano' => 'required|digits:4'
                ];

            }
            default: {
                return [];
            }
        }
    }
}
