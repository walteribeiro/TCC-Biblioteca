<?php

namespace App\Http\Requests;

class LivroRequest extends Request
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
                    'subtitulo' => 'required|max:255',
                    'edicao' => 'required|max:15',
                    'ano' => 'required|size:4',
                    'autor' => 'required',
                    'editora' => 'required'
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'titulo' => 'required|max:255',
                    'subtitulo' => 'required|max:255',
                    'edicao' => 'required|max:15',
                    'ano' => 'required|size:4',
                    'autor' => 'required',
                    'editora' => 'required'
                ];
            }

            default: {
                return [];
            }
        }
    }
}
