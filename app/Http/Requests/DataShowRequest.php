<?php

namespace App\Http\Requests;

class DataShowRequest extends Request
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
                    'marca' => 'max:255',
                    'codigo' => 'required|max:15|unique:data_shows,codigo'
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'descricao' => 'required|max:255',
                    'marca' => 'max:255',
                    'codigo' => 'required|max:15|unique:data_shows,id,recurso_id'
                ];
            }

            default: {
                return [];
            }
        }
    }
}
