<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


route::apiResource('students', StudentController::class);

route::post('register', [AuthController::class, 'register']);
route::post('login', [AuthController::class, 'login']);
route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

route::post('students/{studentID}/subjects', [StudentController::class, 'addSubjectsToStudent']);
route::get('students/{studentID}/subjects', [StudentController::class, 'getStudentSubjects']);
route::get('subjects/{subjectID}/students', [StudentController::class, 'getSubjectStudents']);
