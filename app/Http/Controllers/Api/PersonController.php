<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonCollection;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index()
    {
        //where(['active' => 1])->
        return new PersonCollection(Person::orderBy('lastName')->get());
        /* $persons = Person::where(['active' => 1])->orderBy('lastName')->get();
        return response()->json([
            "data" => $persons,
        ], 200); */
    }
    
    public function store(Request $request)
    {        
        $person = Person::create($request->all());
        return response()->json([
            "message" => "Información registrada correctamente.",
            "data" => $person,
        ], 200);
    }
    
    public function show(Person $person)
    {
        return response()->json([
            "data" => new PersonResource($person),
        ], 200);
    }
   
    public function update(Request $request, Person $person)
    {        
        $person->update($request->all());
        return response()->json([
            "message" => "Información actualizada correctamente.",
            "data" => $person,
        ], 200);
    }
    
    public function destroy(Person $person)
    {
        $person->update([
            "active" => 0,
        ]);
        return response()->json([
            "message" => "Información eliminada correctamente.",
            "data" => $person,
        ], 200);
    }

    public function active(Person $person)
    {
        $person->update([
            "active" => 1,
        ]);
        return response()->json([
            "message" => "Información activada correctamente.",
            "data" => $person,
        ], 200);
    }
    
    //listar todos los que no son alumnos where , 'parent' => null o vacio o el rol apoderado
    public function search(Request $request){
        if($request->type){
            $parents = Person::select('id', 'firstName', 'lastName', 'active')
            ->where(['active' => 1, 'person_type_id' => $request->type])
            ->lastName($request->lastName)
            ->orderBy('lastName')
            ->get();
        }else{
            $parents = Person::select('id', 'firstName', 'lastName', 'active')
            ->where(['active' => 1])
            ->lastName($request->lastName)
            ->orderBy('lastName')
            ->get();
        }             
        return response()->json([
            "data" => $parents,
        ], 200);
    }
}
