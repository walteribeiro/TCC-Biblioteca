<?php

namespace App\Http\Requests;

class AutorRequest extends Request
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
                    'nome' => 'required|min:5|max:255|unique:autores',
                    'sobrenome' => 'required|min:5|max:255'
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'nome' => 'required|min:5|max:255|unique:autores,nome,' . $this->id,
                    'sobrenome' => 'required|min:5|max:255'
                ];

            }

            default: {
                return [];
            }
        }
    }
}
