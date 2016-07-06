<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RevistaRequest extends Request
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
                    'titulo' => 'required|max:255',
                    'referencia' => 'required|size:6',
                    'edicao' => 'required|max:15',
                    'categoria' => 'required|max:255'
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'titulo' => 'required|max:255',
                    'referencia' => 'required|size:6',
                    'edicao' => 'required|max:15',
                    'categoria' => 'required|max:255'
                ];
            }

            default: {
                return [];
            }
        }
    }
}
