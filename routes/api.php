<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/todo', [TodoController::class, 'index']);
    Route::post('/todo', [TodoController::class, 'store']);
    Route::post('/todo/{todo}', [TodoController::class, 'show']);
    Route::patch('/todo/{todo}', [TodoController::class, 'update']);
    Route::patch('/todo/{todo}/completed', [TodoController::class, 'completed']);
    Route::delete('/todo/{todo}', [TodoController::class, 'destroy']);
});


#Route Register dan login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
