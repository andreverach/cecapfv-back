<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassroomCollection;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        //where(['active' => 1])->
        return new ClassroomCollection(Classroom::orderByDesc('id')->get());
        //$classrooms = Classroom::where(['active' => 1])->orderByDesc('id')->get();        
        /* return response()->json([
            "data" => $classrooms,
        ], 200); */
    }

    public function get_actives()
    {
        return new ClassroomCollection(Classroom::where(['active' => 1])->orderByDesc('id')->get());
    }
    
    public function store(Request $request)
    {
        //dd($request->all());
        $classroom = Classroom::create($request->all());
        return response()->json([
            "message" => "Información registrada correctamente.",
            "data" => $classroom,
        ], 200);
    }
    
    public function show(Classroom $classroom)
    {
        return response()->json([
            "data" => new ClassroomResource($classroom),
        ], 200);
    }
   
    public function update(Request $request, Classroom $classroom)
    {        
        $classroom->update($request->all());
        return response()->json([
            "message" => "Información actualizada correctamente.",
            "data" => $classroom,
        ], 200);
    }
    
    public function destroy(Classroom $classroom)
    {
        $classroom->update([
            "active" => 0,
        ]);
        return response()->json([
            "message" => "Información eliminada correctamente.",
            "data" => $classroom,
        ], 200);
    }

    public function active(Classroom $classroom)
    {
        $classroom->update([
            "active" => 1,
        ]);
        return response()->json([
            "message" => "Información activada correctamente.",
            "data" => $classroom,
        ], 200);
    } 
}
