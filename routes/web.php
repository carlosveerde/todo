<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/list-tasks', [App\Http\Controllers\TaskController::class, 'listTasks']);
Route::get('/task/{id}', [App\Http\Controllers\TaskController::class, 'show']);
Route::post('/tasks', [App\Http\Controllers\TaskController::class, 'store']);
Route::put('/task/{id}', [App\Http\Controllers\TaskController::class, 'update']);
Route::delete('/task/{id}', [App\Http\Controllers\TaskController::class, 'destroy']);
