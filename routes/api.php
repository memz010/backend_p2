<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TeacherController;
use App\Http\Controllers\API\ManagerController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// index all rolls of users
Route::apiResource('/students', UserController::class) ;
Route::apiResource('/teachers', TeacherController::class);
Route::apiResource('/managers', ManagerController::class);
// show specific users
Route::apiResource('/students/{id}', UserController::class);
Route::apiResource('/teachers/{id}', TeacherController::class);
Route::apiResource('/managers/{id}', ManagerController::class);
//store a new users
Route::post('/users', [UserController::class, 'store']);
//update
Route::post('/users/{user}', [UserController::class, 'update']);
//delete all rolls of users
Route::delete('/users/{id}', [UserController::class, 'destroy']);








