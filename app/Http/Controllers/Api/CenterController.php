<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Center;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    public function index()
    {
        $centers = Center::orderBy('description')->get();//where(['active' => 1])->
        return response()->json([
            "data" => $centers,
        ], 200);
    }

    public function list(){
        $centers = Center::select('id', 'description')
            ->orderBy('description', 'asc')
            ->where('active', 1)
            ->get();
        return response()->json([
            "data" => $centers,
        ], 200);
    }
    
    public function store(Request $request)
    {
        //dd($request->all());
        $center = Center::create($request->all());
        return response()->json([
            "message" => "Información registrada correctamente.",
            "data" => $center,
        ], 200);
    }
    
    public function show(Center $center)
    {
        return response()->json([
            "data" => $center,
        ], 200);
    }
   
    public function update(Request $request, Center $center)
    {        
        $center->update($request->all());
        return response()->json([
            "message" => "Información actualizada correctamente.",
            "data" => $center,
        ], 200);
    }
    
    public function destroy(Center $center)
    {
        $center->update([
            "active" => 0,
        ]);
        return response()->json([
            "message" => "Información desactivada correctamente.",
            "data" => $center,
        ], 200);
    }

    public function active(Center $center)
    {
        $center->update([
            "active" => 1,
        ]);
        return response()->json([
            "message" => "Información activada correctamente.",
            "data" => $center,
        ], 200);
    }    
}
