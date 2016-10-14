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
                    'codigo' => 'required|max:255|min:3|unique:publicacoes',
                    'titulo' => 'required|max:255',
                    'subtitulo' => 'max:255',
                    'edicao' => 'required|max:15',
                    'ano' => 'required|size:4',
                    'autor' => 'required',
                    'editora' => 'required'
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'codigo' => 'required|max:255|min:3|unique:publicacoes,codigo,'.$this->id,
                    'titulo' => 'required|max:255',
                    'subtitulo' => 'max:255',
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
