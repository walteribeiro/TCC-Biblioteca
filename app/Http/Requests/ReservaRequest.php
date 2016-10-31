<?php

namespace App\Http\Requests;

class ReservaRequest extends Request
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
                    'usuario' => 'required',
                    'data-limite' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'usuario' => 'required',
                    'data-limite' => 'required'
                ];
            }
            default: {
                return [];
            }
        }
    }
}
