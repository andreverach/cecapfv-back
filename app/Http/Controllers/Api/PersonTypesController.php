<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PersonType;
use Illuminate\Http\Request;

class PersonTypesController extends Controller
{
    public function index()
    {
        $personTypes = PersonType::orderBy('id')->get();
        return response()->json([
            "data" => $personTypes,
        ], 200);
    }

    public function list(){
        $personTypes = PersonType::select('id', 'description')
            ->orderBy('description', 'asc')
            ->where('active', 1)
            ->get();
        return response()->json([
            "data" => $personTypes,
        ], 200);
    }
    
    public function store(Request $request)
    {        
        $personType = PersonType::create($request->all());
        return response()->json([
            "message" => "Información registrada correctamente.",
            "data" => $personType,
        ], 200);
    }
    
    public function show(PersonType $personType)
    {
        return response()->json([
            "data" => $personType,
        ], 200);
    }
   
    public function update(Request $request, PersonType $personType)
    {        
        $personType->update($request->all());
        return response()->json([
            "message" => "Información actualizada correctamente.",
            "data" => $personType,
        ], 200);
    }
    
    public function destroy(PersonType $personType)
    {
        $personType->update([
            "active" => 0,
        ]);
        return response()->json([
            "message" => "Información eliminada correctamente.",
            "data" => $personType,
        ], 200);
    }
}
