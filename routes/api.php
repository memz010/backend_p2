<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TeacherController;
use App\Http\Controllers\API\ManagerController;
use App\Http\Controllers\API\SchoolController;
use App\Http\Controllers\API\AdditionController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RelationshipController;
use App\Http\Controllers\API\CertificateController;
use App\Http\Controllers\API\GradeController;
use App\Http\Controllers\API\ExamController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\GuardianController;
use App\Http\Controllers\API\Library_BookController;



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

//
Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [ AuthController::class ,'register']);
    Route::post('/login',[AuthController::class ,'login']);
    Route::middleware('auth:api')->get('/logout', [ AuthController::class ,'logout']);
});
// index all rolls of users
Route::apiResource('/students', UserController::class) ;
Route::apiResource('/teachers', TeacherController::class);
Route::apiResource('/managers', ManagerController::class);
// show specific users
Route::get('/api/students/{id}', [UserController::class, 'show']);
Route::get('/api/teachers/{id}', [TeacherController::class, 'show']);
Route::get('/api/managers/{id}', [ManagerController::class, 'show']);

//Route::middleware('auth:api','admin')->group(function () {
    Route::post('/users', [UserController::class, 'store']);
    //update information users
    Route::post('/users/{user}', [UserController::class, 'update']);
    //delete all rolls of users
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
//});
//store a new users

// CRUD for all schools
Route::get('schools/search', [SchoolController::class, 'searchSchools']);
Route::apiResource('/schools',SchoolController::class,) ;
Route::get('/api/schools/{id}', [SchoolController::class, 'show']);
// search for all schools

//
//Route::middleware('auth:api','admin')->group(function () {
Route::post('/schools', [SchoolController::class, 'store']);
Route::post('/api/schools/{school}', [SchoolController::class, 'update']);
Route::delete('/schools/{id}', [SchoolController::class, 'destroy']);
//});
// CRUD for all Addition
// get all addition ...
Route::apiResource('/additions',AdditionController::class,) ;
Route::get('/api/additions/{id}', [AdditionController::class, 'show']);
//
//Route::middleware('auth:api','admin')->group(function () {

Route::post('/additions', [AdditionController::class, 'store']);
Route::post('/additions/{addition}', [AdditionController::class, 'update']);
Route::delete('/additions/{id}', [AdditionController::class, 'destroy']);
//});
// Relationship //
Route::get('schools/{id}/students', [RelationshipController::class, 'schoolstudents']);
Route::get('schools/{id}/teachers', [RelationshipController::class, 'schoolteachers']);
Route::get('schools/{id}/managers', [RelationshipController::class, 'schoolmanagers']);
// show Certificate //

Route::apiResource('/certificate', CertificateController::class) ;
Route::get('/api/certificate/{id}', [CertificateController::class, 'show']);
// crud by admin
//Route::middleware('auth:api','admin')->group(function () {

Route::post('/certificate', [CertificateController::class, 'store']);
Route::post('/certificate/{id}', [CertificateController::class, 'update']);
Route::delete('/certificate/{id}', [CertificateController::class, 'destroy']);

//});
// crud all grades //
Route::apiResource('/grades', GradeController::class) ;
Route::get('/api/grades/{id}', [GradeController::class, 'show']);

Route::middleware('auth:api','admin')->group(function () {

Route::post('/grades', [GradeController::class, 'store']);
Route::post('/grades/{id}', [GradeController::class, 'update']);
Route::delete('/grades/{grade}', [GradeController::class, 'destroy']);

});
// crud all exam //
Route::apiResource('/exams', ExamController::class) ;
Route::get('/api/exams/{id}', [ExamController::class, 'show']);

//Route::middleware('auth:api','admin')->group(function () {

Route::post('/exams', [ExamController::class, 'store']);
Route::post('/exams/{id}', [ExamController::class, 'update']);
Route::delete('/exams/{exam}', [ExamController::class, 'destroy']);

// });

// CRUD BOOK //
Route::apiResource('/books', BookController::class) ;
Route::get('/api/books/{id}', [BookController::class, 'show']);
// crud by admin
//Route::middleware('auth:api','admin')->group(function () {

Route::post('/books', [BookController::class, 'store']);
Route::post('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);
// });

// CRUD GuardianController //
Route::apiResource('/Guardians', GuardianController::class) ;
Route::get('/api/Guardians/{id}', [GuardianController::class, 'show']);
// crud by admin
//Route::middleware('auth:api','admin')->group(function () {
Route::post('/Guardians', [GuardianController::class, 'store']);
// });

// CRUD Library_Book //
Route::apiResource('/Library_books', Library_BookController::class) ;
Route::get('/api/Library_books/{id}', [Library_BookController::class, 'show']);
// crud by admin
//Route::middleware('auth:api','admin')->group(function () {

Route::post('/Library_books', [Library_BookController::class, 'store']);
Route::post('/Library_books/{id}', [Library_BookController::class, 'update']);
Route::delete('/Library_books/{id}', [Library_BookController::class, 'destroy']);
// });


