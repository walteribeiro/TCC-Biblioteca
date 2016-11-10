<?php

namespace App\Http\Requests;

use App\User;

class FuncionarioRequest extends Request
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
                    'nome' => 'required|min:5|max:255',
                    'telefone' => 'min:10|max:15',
                    'telefone2' => 'min:10|max:15',
                    'email' => 'required|min:10|max:255|unique:pessoas',
                    'numeroRegistro' => 'required|min:5|max:10|unique:funcionarios,num_registro',
                    'tipoFuncionario' => 'required',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'nome' => 'required|min:5|max:255',
                    'telefone' => 'min:10|max:15',
                    'telefone2' => 'min:10|max:15',
                    'email' => 'required|min:10|max:255|unique:pessoas,email, ' . $this->id,
                    'numeroRegistro' => 'required|max:10',
                    'tipoFuncionario' => 'required',
                ];
            }

            default: {
                return [];
            }
        }
    }
}
