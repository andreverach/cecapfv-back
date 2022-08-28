<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonClassroomRequest;
use App\Http\Resources\PersonClassroomCollection;
use App\Http\Resources\PersonClassroomResource;
use App\Models\PersonClassroom;
use Illuminate\Http\Request;

class PersonClassroomsController extends Controller
{
    public function index()
    {
        //ordenar por apellido del alumno
        //where(['active' => 1])->
        return new PersonClassroomCollection(
            PersonClassroom::select(
                'person_classroom.id as id',
                'person_classroom.person_id as person_id',
                'person_classroom.classroom_id as classroom_id',
                'person_classroom.active as active',
                'person_classroom.created_at as created_at',
                'person_classroom.updated_at as updated_at',
                'persons.id as persons_id',
                'persons.lastName as persons_lastName',
            )
            ->join('persons', 'persons.id', '=', 'person_classroom.person_id')
            ->orderBy('persons.lastName')
            ->get()
        );
    }
    
    public function store(PersonClassroomRequest $request)
    {        
        $personClassroom = PersonClassroom::create($request->all());
        return response()->json([
            "message" => "Información registrada correctamente.",
            "data" => $personClassroom,
        ], 200);
    }
    
    public function show(PersonClassroom $personClassroom)
    {
        return response()->json([
            "data" => new PersonClassroomResource($personClassroom),
        ], 200);
    }
   
    public function update(PersonClassroomRequest $request, PersonClassroom $personClassroom)
    {        
        $personClassroom->update($request->all());
        return response()->json([
            "message" => "Información actualizada correctamente.",
            "data" => $personClassroom,
        ], 200);
    }
    
    public function destroy(PersonClassroom $personClassroom)
    {
        $personClassroom->update([
            "active" => 0,
        ]);
        return response()->json([
            "message" => "Información eliminada correctamente.",
            "data" => $personClassroom,
        ], 200);
    }

    public function active(PersonClassroom $personClassroom)
    {
        $personClassroom->update([
            "active" => 1,
        ]);
        return response()->json([
            "message" => "Información activada correctamente.",
            "data" => $personClassroom,
        ], 200);
    }

    //listar los alumnos asignados a una clase filtrando por apellido
    public function search(Request $request){
        $students = PersonClassroom::select(
                'person_classroom.id as id',
                'person_classroom.person_id as person_id',
                'person_classroom.classroom_id as classroom_id',
                'person_classroom.active as active',
                'person_classroom.created_at as created_at',
                'person_classroom.updated_at as updated_at',
                'persons.id as persons_id',
                'persons.lastName as persons_lastName',
            )
            ->join('persons', 'persons.id', '=', 'person_classroom.person_id')
            ->studenAssign($request->lastName)
            ->orderBy('persons.lastName')
            ->get();
        return new PersonClassroomCollection($students);
    }
    
    public function students_list(Request $request)
    {
        $students = PersonClassroom::select(
            'person_classroom.id as id',
            'person_classroom.person_id as person_id',
            'person_classroom.classroom_id as classroom_id',
            'person_classroom.active as active',
            'person_classroom.created_at as created_at',
            'person_classroom.updated_at as updated_at',
            'persons.id as persons_id',
            'persons.lastName as persons_lastName',
        )
        ->join('persons', 'persons.id', '=', 'person_classroom.person_id')
        ->where(['classroom_id' => $request->classroom])
        ->orderBy('persons.lastName')
        ->get();
        return new PersonClassroomCollection($students);
    }
}
