<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CourseController as CourseController;
use App\Http\Controllers\Api\CenterController as CenterController;
use App\Http\Controllers\Api\AssistanceController as AssistanceController;
use App\Http\Controllers\Api\ClassroomController as ClassroomController;
use App\Http\Controllers\Api\PersonController as PersonController;
use App\Http\Controllers\Api\ScheduleController as ScheduleController;
use App\Http\Controllers\Api\SchoolController as SchoolController;
use App\Http\Controllers\Api\PersonClassroomsController as PersonClassroomsController;
use App\Http\Controllers\Api\PersonTypesController as PersonTypesController;

//centers
Route::get('centers/list', [CenterController::class, 'list'])
  ->name('api.centers.list');//aunque no es necesario los name, si es necesario las rutas personalizadas primero y despues las resource
Route::post('centers/active/{center}', [CenterController::class, 'active'])
  ->name('api.centers.active');

//courses
Route::get('courses/list', [CourseController::class, 'list'])
  ->name('api.courses.list');
Route::post('courses/active/{course}', [CourseController::class, 'active'])
  ->name('api.courses.active');

//schools
Route::get('schools/list', [SchoolController::class, 'list'])
  ->name('api.schools.list');
Route::post('schools/active/{school}', [SchoolController::class, 'active'])
  ->name('api.schools.active');

//person-types
Route::get('person-types/list', [PersonTypesController::class, 'list'])
  ->name('api.person-types.list');

//persons
Route::post('persons/active/{person}', [PersonController::class, 'active'])
  ->name('api.persons.active');
Route::post('persons/search',  [PersonController::class, 'search'])
    ->name('api.persons.search');

//schedules
Route::post('schedules/active/{schedule}', [ScheduleController::class, 'active'])
  ->name('api.schedules.active');
Route::get('schedules/available', [ScheduleController::class, 'available_schedules'])
  ->name('api.schedules.available');

//classrooms
Route::post('classrooms/active/{classroom}', [ClassroomController::class, 'active'])
  ->name('api.classrooms.active');
Route::get('classrooms/actives', [ClassroomController::class, 'get_actives'])
  ->name('api.classrooms.actives');

//classrooms
Route::post('person-classrooms/active/{personClassroom}', [PersonClassroomsController::class, 'active'])
  ->name('api.person-classrooms.active');
Route::post('person-classrooms/search',  [PersonClassroomsController::class, 'search'])
    ->name('api.person-classrooms.search');
Route::get('person-classrooms/students-list/{classroom}',  [PersonClassroomsController::class, 'students_list'])
    ->name('api.person-classrooms.students-list');

//assistances
Route::get('assistances/student/{student}/class/{classroom}',  [AssistanceController::class, 'record_student_classroom'])
    ->name('api.assistances.record-student-classroom');


//rutas basic api
Route::apiResource('courses', CourseController::class);
Route::apiResource('centers', CenterController::class);
Route::apiResource('assistances', AssistanceController::class);
Route::apiResource('classrooms', ClassroomController::class);
Route::apiResource('persons', PersonController::class);
Route::apiResource('schedules', ScheduleController::class);
Route::apiResource('schools', SchoolController::class);
Route::apiResource('person-classrooms', PersonClassroomsController::class);
Route::apiResource('person-types', PersonTypesController::class);

/*
Modelos y Controladores:
php artisan make:controller Api/CourseController --api --model=Course
php artisan make:controller Api/AssistanceController --api --model=Assistance
php artisan make:controller Api/ClassroomController --api --model=Classroom
php artisan make:controller Api/PersonController --api --model=Person
php artisan make:controller Api/ScheduleController --api --model=Schedule
php artisan make:controller Api/SchoolController --api --model=School
php artisan make:controller Api/PersonClassroomsController --api --model=PersonClassroom
php artisan make:controller Api/CenterController --api --model=Center
php artisan make:controller Api/PersonTypesController --api --model=PersonType

Recursos y Colecciones:
php artisan make:resource ClassroomResource
php artisan make:resource ClassroomCollection

php artisan make:resource PersonResource
php artisan make:resource PersonCollection

php artisan make:resource AssistanceResource
php artisan make:resource AssistanceCollection

php artisan make:resource PersonClassroomResource
php artisan make:resource PersonClassroomCollection

*/