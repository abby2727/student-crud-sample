<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::view('/dashboard', 'dashboard');

//* Student routes
Route::resource('students', StudentController::class);

// For assigning/unassigning courses
Route::post('/students/{student}/courses', [StudentController::class, 'updateCourses'])->name('students.updateCourses');

Route::view('/teachers', 'dashboard'); // Replace with actual teachers view
Route::view('/courses', 'dashboard');  // Replace with actual courses view

Route::redirect('/', '/dashboard');
