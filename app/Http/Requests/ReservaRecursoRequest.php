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
                    'aula' => 'required|unique:reserva_recursos,aula'
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'recurso' => 'required',
                    'funcionario' => 'required',
                    'aula' => 'required|unique:reserva_recursos,aula,'.$this->id
                ];
            }

            default: {
                return [];
            }
        }

        /*
        Validator::extend('composite_unique', function ($attribute, $value, $parameters, $validator) {

            // remove first parameter and assume it is the table name
            $table = array_shift($parameters);

            // start building the conditions
            $fields = [$attribute => $value]; // current field, company_code in your case

            // iterates over the other parameters and build the conditions for all the required fields
            while ($field = array_shift($parameters)) {
                $fields[$field] = $this->get($field);
            }

            $result = ReservaRecurso::where($fields);

            return ($result->count() == 0); // edited here
        }, 'your custom composite unique key validation message');

        switch ($this->method()) {
            case 'POST': {
                return [
                    'data_reserva' => 'composite_unique:reserva_recursos,aula'
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
        }*/
    }
}
