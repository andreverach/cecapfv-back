<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{   
    public function toArray($request)
    {
        return [
            'id' =>$this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'phone' => $this->phone,            
            'birthdate' => $this->birthdate,
            'dni' => $this->dni,
            'hisParent' => $this->his_parent,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'hisSchool' => $this->his_school,
            'type' => $this->person_type,
        ];
    }
}
