<?php

namespace App\Http\Requests;

class DataShowRequest extends Request
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
                    'descricao' => 'required|max:255',
                    'marca' => 'max:255',
                    'codigo' => 'required|max:15'
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'descricao' => 'required|max:255',
                    'marca' => 'max:255',
                    'codigo' => 'required|max:15'
                ];
            }

            default: {
                return [];
            }
        }
    }
}
