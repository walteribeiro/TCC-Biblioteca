<?php

namespace App\Http\Requests;

class EmprestimoRequest extends Request
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
                    'usuario' => 'required',
                    'data-prevista' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [

                ];

            }
            default: {
                return [];
            }
        }
    }
}
