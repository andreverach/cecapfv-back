<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{   
    public function index()
    {
        $courses = Course::orderBy('description')->get();
        return response()->json([
            "data" => $courses,
        ], 200);
    }

    public function list(){
        $courses = Course::select('id', 'description')
            ->orderBy('description', 'asc')
            ->where('active', 1)
            ->get();
        return response()->json([
            "data" => $courses,
        ], 200);
    }
    
    public function store(Request $request)
    {
        //dd($request->all());
        $course = Course::create($request->all());
        return response()->json([
            "message" => "Información registrada correctamente.",
            "data" => $course,
        ], 200);
    }
    
    public function show(Course $course)
    {
        return response()->json([
            "data" => $course,
        ], 200);
    }
   
    public function update(Request $request, Course $course)
    {        
        $course->update($request->all());
        return response()->json([
            "message" => "Información actualizada correctamente.",
            "data" => $course,
        ], 200);
    }
    
    public function destroy(Course $course)
    {
        $course->update([
            "active" => 0,
        ]);
        return response()->json([
            "message" => "Información eliminada correctamente.",
            "data" => $course,
        ], 200);
    }

    public function active(Course $course)
    {
        $course->update([
            "active" => 1,
        ]);
        return response()->json([
            "message" => "Información activada correctamente.",
            "data" => $course,
        ], 200);
    }
}
