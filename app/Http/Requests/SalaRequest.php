<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SalaRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'POST': {
                return [
                    'descricao' => 'required|max:255',
                    'tipo_sala' => 'required'
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'descricao' => 'required|max:255',
                    'tipo_sala' => 'required',
                ];
            }

            default: {
                return [];
            }
        }
    }
}
