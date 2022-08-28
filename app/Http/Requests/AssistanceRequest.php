<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssistanceRequest extends FormRequest
{    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'person_id' => [
                'required',
                Rule::unique('assistances')->where(function ($query) {
                    $query->where('classroom_id', $this->classroom_id)
                    ->where('date', $this->date);
                })->ignore($this->assistance),
            ],
            'classroom_id' => 'required',
            'attend' => 'required',
            'date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'person_id.required' => 'El Alumno es requerido',
            'person_id.unique' => 'Asistencia o falta ya registrada',
            'classroom_id.required' => 'La clase es requerida',
            'attend.required' => 'La asistencia o falta es requerida',
            'date.required' => 'La fecha es requerida',
        ];
    }
}
