<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ScheduleRequest extends FormRequest
{    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        //con ese unico unique con la funcion de where hago que esa combinacion de campos sea unica
        //tambien se podria agregar el campo active == 1, osea que si algun horario esta inactivo a ese no
        //lo va a tomar en cuenta para verificar si el horario existe, de momento va a verificar todos
        return [
            'turno' => [
                'required',
                Rule::unique('schedules')->where(function ($query) {
                    $query->where('start_time', $this->start_time)
                    ->where('end_time', $this->end_time)
                    ->where('dia', $this->dia);
                })->ignore($this->schedule),
            ],
            'dia' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'turno.required' => 'El turno es requerido',
            'turno.unique' => 'El horario ya existe, por favor verificar',
            'dia.required' => 'El día es requerido',
            'start_time.required' => 'La hora de inicio es requerida',
            'end_time.required' => 'La hora de término es requerida',
        ];
    }
}
