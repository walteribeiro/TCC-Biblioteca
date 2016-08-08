<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MapaRequest extends Request
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
                    'titulo' => 'max:255',
                    'numero' => 'required|max:15|unique:mapas,numero'
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'descricao' => 'required|max:255',
                    'titulo' => 'max:255',
                    'numero' => 'required|max:15|unique:mapas,numero,'. $this->id
                ];
            }

            default: {
                return [];
            }
        }
    }
}
