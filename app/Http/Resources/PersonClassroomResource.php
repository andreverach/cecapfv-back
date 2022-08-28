<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonClassroomResource extends JsonResource
{    
    public function toArray($request)
    {
        return [
            'id' =>$this->id,            
            'active' => $this->active,            
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,        
            'person' => [
                'id' => $this->person->id,
                'firstName' => $this->person->firstName,
                'lastName' => $this->person->lastName,
                'type' => $this->person->person_type,
            ],
            'classroom' => [
                'id' => $this->classroom->id,
                'schedule' => [
                    'id' => $this->classroom->schedule->id,
                    'turno' => $this->classroom->schedule->turno,
                    'start_time' => $this->classroom->schedule->start_time,
                    'end_time' => $this->classroom->schedule->end_time,
                    'dia' => $this->classroom->schedule->dia,
                ],
                'course' => [
                    'id' => $this->classroom->course->id,
                    'description' => $this->classroom->course->description,
                ],
                'center' => [
                    'id' => $this->classroom->center->id,
                    'description' => $this->classroom->center->description,
                ],
                'professor' => [
                    'id' => $this->classroom->person->id,
                    'firstName' => $this->classroom->person->firstName,
                    'lastName' => $this->classroom->person->lastName,
                    'type' => $this->classroom->person->person_type,
                ],
            ],
        ];
    }
}
