<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::view('/dashboard', 'dashboard');

//* Student routes
Route::resource('students', StudentController::class);

// For assigning/unassigning courses
Route::post('/students/{student}/courses', [StudentController::class, 'updateCourses'])->name('students.updateCourses');

//* Teacher routes
Route::resource('teachers', TeacherController::class);

Route::view('/courses', 'dashboard');  // Replace with actual courses view

Route::redirect('/', '/dashboard');
