<?php

use Illuminate\Support\Facades\Route;

Route::view('/dashboard', 'dashboard');
Route::view('/students', 'dashboard'); // Replace with actual students view
Route::view('/teachers', 'dashboard'); // Replace with actual teachers view
Route::view('/courses', 'dashboard');  // Replace with actual courses view

Route::redirect('/', '/dashboard');
