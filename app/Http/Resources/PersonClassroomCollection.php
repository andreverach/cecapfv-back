<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PersonClassroomCollection extends ResourceCollection
{    
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'organization' => 'CecapFv',
                'authors' => [
                    'CecapFv'
                ]
            ],
            'type' => 'Listado del profesor - PersonClassroom'
        ];
    }
}
