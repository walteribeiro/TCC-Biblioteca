<?php

namespace App\Http\Requests;

use App\User;

class EditoraRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $user;

    public function authorize(User $user)
    {
        //dd($user->name);
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
