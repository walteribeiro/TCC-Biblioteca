<?php

namespace App\Http\Requests;

class AlunoRequest extends Request
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
                    'username' => 'min:5|max:10|unique:pessoas',
                    'senha' => 'min:5|max:15|confirmed:senha_confirmation',
                    'nome' => 'required|min:5|max:255',
                    'telefone' => 'required|min:10|max:15',
                    'telefone2' => 'min:10|max:15',
                    'email' => 'min:10|max:255|unique:pessoas',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'username' => 'min:5|max:10|unique:pessoas,username, ' . $this->id,
                    'senha' => 'min:5|max:15|confirmed:senha_confirmation',
                    'nome' => 'required|min:5|max:255',
                    'telefone' => 'required|min:10|max:15',
                    'telefone2' => 'min:10|max:15',
                    'email' => 'min:10|max:255|unique:pessoas,email, ' . $this->id,
                ];
            }

            default: {
                return [];
            }
        }
    }
}
