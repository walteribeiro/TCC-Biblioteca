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
                    'nome' => 'required|min:1|max:255|unique:autores',
                    'sobrenome' => 'min:1|max:255'
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'nome' => 'required|min:1|max:255|unique:autores,nome,' . $this->id,
                    'sobrenome' => 'min:1|max:255'
                ];

            }

            default: {
                return [];
            }
        }
    }
}
