<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AutorRequest extends Request
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
        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'nome' => 'required|min:5|max:255|unique:autores',
                    'sobrenome' => 'required|min:5|max:255'
                ];
            }

            case 'PUT':
            case 'PATCH':
            {
                return [
                    'nome' => 'required|min:5|max:255|unique:autores,nome,'.$this->id,
                    'sobrenome' => 'required|min:5|max:255'
                ];

            }

            default:
            {
                return [];
            }
        }
    }
}
