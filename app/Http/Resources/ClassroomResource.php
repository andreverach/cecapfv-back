<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{    
    public function toArray($request)
    {
        return [
            'id' =>$this->id,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,            
            'schedule' => $this->schedule,
            'course' => $this->course,
            'center' => $this->center,
            'professor' => $this->person,
        ];
    }
}
