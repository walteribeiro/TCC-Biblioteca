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
    public function authorize(User $user)
    {
//        dd($user);
//        if(isset($user)){
//            if($user->tipo_acesso != 0){
//                return false;
//            }
//        }
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
                    'username' => 'required|min:5|max:10|unique:pessoas',
                    'senha' => 'min:5|max:15|confirmed:senha_confirmation',
                    'nome' => 'required|min:5|max:255',
                    'telefone' => 'required|min:10|max:15',
                    'telefone2' => 'min:10|max:15',
                    'email' => 'min:10|max:255|unique:pessoas',
                    'numeroRegistro' => 'min:5|max:10|unique:funcionarios,num_registro',
                    'tipoFuncionario' => 'required',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'username' => 'required|min:5|max:10|unique:pessoas,username, ' . $this->id,
                    'senha' => 'min:5|max:15|confirmed:senha_confirmation',
                    'nome' => 'required|min:5|max:255',
                    'telefone' => 'required|min:10|max:15',
                    'telefone2' => 'min:10|max:15',
                    'email' => 'min:10|max:255|unique:pessoas,email, ' . $this->id,
                    'numeroRegistro' => 'max:10|unique:funcionarios,id,user_id',
                    'tipoFuncionario' => 'required',
                ];
            }

            default: {
                return [];
            }
        }
    }
}
