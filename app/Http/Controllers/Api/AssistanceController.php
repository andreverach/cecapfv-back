<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssistanceRequest;
use App\Http\Resources\AssistanceCollection;
use App\Http\Resources\AssistanceResource;
use App\Models\Assistance;
use Illuminate\Http\Request;

class AssistanceController extends Controller
{
    public function index()
    {
        return new AssistanceCollection(Assistance::where(['active' => 1])->orderByDesc('id')->get());
    }
    
    public function store(AssistanceRequest $request)
    {
        //dd($request->all());
        $assistance = Assistance::create($request->all());
        return response()->json([
            "message" => "Información registrada correctamente.",
            "data" => $assistance,
        ], 200);
    }
    
    public function show(Assistance $assistance)
    {
        return response()->json([
            "data" => new AssistanceResource($assistance),
        ], 200);
    }
   
    public function update(AssistanceRequest $request, Assistance $assistance)
    {        
        $assistance->update($request->all());
        return response()->json([
            "message" => "Información actualizada correctamente.",
            "data" => $assistance,
        ], 200);
    }
    
    public function destroy(Assistance $assistance)
    {
        $assistance->update([
            "active" => 0,
        ]);
        return response()->json([
            "message" => "Información eliminada correctamente.",
            "data" => $assistance,
        ], 200);
    }
}
