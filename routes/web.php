<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::view('/dashboard', 'dashboard');

//* Student routes
// Update test
Route::resource('students', StudentController::class);

// For assigning/unassigning courses
Route::post('/students/{student}/courses', [StudentController::class, 'updateCourses'])->name('students.updateCourses');

//* Teacher routes
Route::resource('teachers', TeacherController::class);

//* Course routes
Route::resource('courses', CourseController::class);

// For assigning/unassigning students to course
Route::post('/courses/{course}/students', [CourseController::class, 'updateStudents'])->name('courses.updateStudents');

Route::redirect('/', '/dashboard');
