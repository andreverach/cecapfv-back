<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        //where(['active' => 1])->
        $schedules = Schedule::orderBy('turno')->get();
        return response()->json([
            "data" => $schedules,
        ], 200);
    }

    public function available_schedules(){
        $schedules = Schedule::select('id', 'turno', 'dia', 'start_time', 'end_time')
            ->orderBy('dia', 'asc')
            ->where('active', 1)
            ->get();
        return response()->json([
            "data" => $schedules,
        ], 200);
    }
    
    public function store(ScheduleRequest $request)
    {
        //dd($request->all());
        $schedule = Schedule::create($request->all());
        return response()->json([
            "message" => "Información registrada correctamente.",
            "data" => $schedule,
        ], 200);
    }
    
    public function show(Schedule $schedule)
    {
        return response()->json([
            "data" => $schedule,
        ], 200);
    }
   
    public function update(ScheduleRequest $request, Schedule $schedule)
    {        
        $schedule->update($request->all());
        return response()->json([
            "message" => "Información actualizada correctamente.",
            "data" => $schedule,
        ], 200);
    }
    
    public function destroy(Schedule $schedule)
    {
        $schedule->update([
            "active" => 0,
        ]);
        return response()->json([
            "message" => "Información eliminada correctamente.",
            "data" => $schedule,
        ], 200);
    }

    public function active(Schedule $schedule)
    {
        $schedule->update([
            "active" => 1,
        ]);
        return response()->json([
            "message" => "Información activada correctamente.",
            "data" => $schedule,
        ], 200);
    } 
}
