<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::orderBy('description')->get();
        return response()->json([
            "data" => $schools,
        ], 200);
    }

    public function list(){
        $schools = School::select('id', 'description')
            ->orderBy('description', 'asc')
            ->where('active', 1)
            ->get();
        return response()->json([
            "data" => $schools,
        ], 200);
    }
    
    public function store(Request $request)
    {
        //dd($request->all());
        $school = School::create($request->all());
        return response()->json([
            "message" => "Información registrada correctamente.",
            "data" => $school,
        ], 200);
    }
    
    public function show(School $school)
    {
        return response()->json([
            "data" => $school,
        ], 200);
    }
   
    public function update(Request $request, School $school)
    {        
        $school->update($request->all());
        return response()->json([
            "message" => "Información actualizada correctamente.",
            "data" => $school,
        ], 200);
    }
    
    public function destroy(School $school)
    {
        $school->update([
            "active" => 0,
        ]);
        return response()->json([
            "message" => "Información eliminada correctamente.",
            "data" => $school,
        ], 200);
    }

    public function active(School $school)
    {
        $school->update([
            "active" => 1,
        ]);
        return response()->json([
            "message" => "Información activada correctamente.",
            "data" => $school,
        ], 200);
    }   
}
