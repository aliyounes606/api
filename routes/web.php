<?php

use App\Http\Controllers\StudentCardController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::resource('student', StudentController::class);

