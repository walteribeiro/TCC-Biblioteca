<?php

namespace App\Http\Requests;

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
                    'username' => 'required_if:password|min:5|max:10|unique:pessoas',
                    'password' => 'required_if:username|min:5|max:15',
                    'nome' => 'required|min:5|max:255',
                    'telefone' => 'required|min:10|max:15',
                    'telefone2' => 'min:10|max:15',
                    'email' => 'min:10|max:255|unique:pessoas',
                    'ativo' => 'boolean',
                    'num_registro' => 'min:5|max:10|unique:funcionarios',
                    'tipo_funcionario' => 'required',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'username' => 'required_if:password|min:5|max:10|unique:pessoas, ' . $this->id,
                    'password' => 'required_if:username|min:5|max:15',
                    'nome' => 'required|min:5|max:255',
                    'telefone' => 'required|min:10|max:15',
                    'telefone2' => 'min:10|max:15',
                    'email' => 'min:10|max:255|unique:pessoas, ' . $this->id,
                    'ativo' => 'boolean',
                    'num_registro' => 'required|max:10|unique:funcionarios, ' . $this->id,
                    'tipo_funcionario' => 'required',
                ];
            }

            default: {
                return [];
            }
        }
    }
}
