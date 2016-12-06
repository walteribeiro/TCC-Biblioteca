<?php

namespace App\Http\Requests;

class ReservaRecursoRequest extends Request
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
                    'recurso' => 'required',
                    'funcionario' => 'required',
                    'aula' => 'required'
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'recurso' => 'required',
                    'funcionario' => 'required',
                    'aula' => 'required'
                ];
            }

            default: {
                return [];
            }
        }
    }
}
