<?php

namespace App\Http\Requests;

use App\User;

class EditoraRequest extends Request
{
    protected $user;

    public function authorize(User $user)
    {
        //dd($user->name);
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'POST': {
                return [
                    'nome' => 'required|min:5|max:255|unique:editoras'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'nome' => 'required|min:5|max:255|unique:editoras,nome,' . $this->id,
                ];

            }
            default: {
                return [];
            }
        }
    }
}
