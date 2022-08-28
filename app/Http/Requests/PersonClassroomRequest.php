<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonClassroomRequest extends FormRequest
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
                Rule::unique('person_classroom')->where(function ($query) {
                    $query->where('classroom_id', $this->classroom_id);
                })->ignore($this->person_classroom),
            ],
            'classroom_id' => 'required',            
        ];
    }

    public function messages()
    {
        return [
            'person_id.required' => 'El alumno es requerido',
            'person_id.unique' => 'El alumno ya se encuentra asignado a esta clase',
            'classroom_id.required' => 'La clase es requerida',            
        ];
    }
}
