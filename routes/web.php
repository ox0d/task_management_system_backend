<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Test
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// Task routes
Route::resource('tasks', TaskController::class);
