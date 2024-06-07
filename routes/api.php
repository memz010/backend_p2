<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TeacherController;
use App\Http\Controllers\API\ManagerController;
use App\Http\Controllers\API\SchoolController;
use App\Http\Controllers\API\AdditionController;


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
Route::get('/api/students/{id}', [UserController::class, 'show']);
Route::get('/api/teachers/{id}', [TeacherController::class, 'show']);
Route::get('/api/managers/{id}', [ManagerController::class, 'show']);
//store a new users
Route::post('/users', [UserController::class, 'store']);
//update information users
Route::post('/users/{user}', [UserController::class, 'update']);
//delete all rolls of users
Route::delete('/users/{id}', [UserController::class, 'destroy']);
// CRUD for all schools
Route::apiResource('/schools',SchoolController::class,) ;
Route::get('/api/schools/{id}', [SchoolController::class, 'show']);
Route::post('/schools', [SchoolController::class, 'store']);
Route::post('/api/schools/{school}', [SchoolController::class, 'update']);
Route::delete('/schools/{id}', [SchoolController::class, 'destroy']);
// CRUD for all Addition
Route::apiResource('/additions',AdditionController::class,) ;
Route::get('/api/additions/{id}', [AdditionController::class, 'show']);
Route::post('/additions', [AdditionController::class, 'store']);
Route::post('/additions/{addition}', [AdditionController::class, 'update']);
Route::delete('/schools/{id}', [AdditionController::class, 'destroy']);
// 






