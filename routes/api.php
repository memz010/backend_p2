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
use App\Http\Controllers\API\LibrarieController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\SectionController;
use App\Http\Controllers\API\StageController;
use App\Http\Controllers\API\SubjectController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\SubmissionController;
use App\Http\Controllers\API\MarkController;


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

Route::middleware('auth:api','admin')->group(function () {
    Route::post('/users', [UserController::class, 'store']);
    //update information users
    Route::post('/users/{user}', [UserController::class, 'update']);
    //delete all rolls of users
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});
//store a new users

// CRUD for all schools
Route::get('schools/search', [SchoolController::class, 'searchSchools']);
Route::apiResource('/schools',SchoolController::class,) ;
Route::get('/api/schools/{id}', [SchoolController::class, 'show']);
// search for all schools

//
Route::middleware('auth:api','admin')->group(function () {
Route::post('/schools', [SchoolController::class, 'store']);
Route::post('/schools/{id}', [SchoolController::class, 'update']);
Route::delete('/schools/{id}', [SchoolController::class, 'destroy']);
});
// CRUD for all Addition
// get all addition ...
Route::apiResource('/additions',AdditionController::class,) ;
Route::get('/api/additions/{id}', [AdditionController::class, 'show']);
//
Route::middleware('auth:api','admin')->group(function () {

Route::post('/additions', [AdditionController::class, 'store']);
Route::post('/additions/{addition}', [AdditionController::class, 'update']);
Route::delete('/additions/{id}', [AdditionController::class, 'destroy']);
});
// Relationship //
Route::get('schools/{id}/students', [RelationshipController::class, 'schoolstudents']);
Route::get('schools/{id}/teachers', [RelationshipController::class, 'schoolteachers']);
Route::get('schools/{id}/managers', [RelationshipController::class, 'schoolmanagers']);
// show Certificate //

Route::apiResource('/certificate', CertificateController::class) ;
Route::get('/api/certificate/{id}', [CertificateController::class, 'show']);
// crud by admin

Route::middleware('auth:api','admin')->group(function () {

Route::post('/certificate', [CertificateController::class, 'store']);
Route::post('/certificate/{id}', [CertificateController::class, 'update']);
Route::delete('/certificate/{id}', [CertificateController::class, 'destroy']);

});
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

Route::middleware('auth:api','admin')->group(function () {

Route::post('/exams', [ExamController::class, 'store']);
Route::post('/exams/{id}', [ExamController::class, 'update']);
Route::delete('/exams/{exam}', [ExamController::class, 'destroy']);

 });

// CRUD BOOK //
Route::apiResource('/books', BookController::class) ;
Route::get('/api/books/{id}', [BookController::class, 'show']);
// crud by admin
Route::middleware('auth:api','admin')->group(function () {

Route::post('/books', [BookController::class, 'store']);
Route::post('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);
 });

// CRUD GuardianController //
Route::apiResource('/Guardians', GuardianController::class) ;
Route::get('/api/Guardians/{id}', [GuardianController::class, 'show']);
// crud by admin
Route::middleware('auth:api','admin')->group(function () {
Route::post('/Guardians', [GuardianController::class, 'store']);
 });

// CRUD Library_Book //
Route::apiResource('/Library_books', Library_BookController::class) ;
Route::get('/api/Library_books/{id}', [Library_BookController::class, 'show']);
// crud by admin
Route::middleware('auth:api','admin')->group(function () {

Route::post('/Library_books', [Library_BookController::class, 'store']);
Route::post('/Library_books/{id}', [Library_BookController::class, 'update']);
Route::delete('/Library_books/{id}', [Library_BookController::class, 'destroy']);
 });

// CRUD Library_ //
Route::apiResource('/Libraries', LibrarieController::class) ;
Route::get('/api/Libraries/{id}', [LibrarieController::class, 'show']);
// crud by admin
Route::middleware('auth:api','admin')->group(function () {

Route::post('/Libraries', [LibrarieController::class, 'store']);
Route::post('/Libraries/{id}', [LibrarieController::class, 'update']);
Route::delete('/Libraries/{id}', [LibrarieController::class, 'destroy']);
 });


// crud all Reports //
Route::apiResource('/Reports', ReportController::class) ;
Route::get('/api/Reports/{id}', [ReportController::class, 'show']);

Route::middleware('auth:api','admin')->group(function () {

Route::post('/Reports', [ReportController::class, 'store']);
Route::post('/Reports/{id}', [ReportController::class, 'update']);
Route::delete('/Reports/{Report}', [ReportController::class, 'destroy']);

});

// crud all section //
Route::apiResource('/Sections', SectionController::class) ;
Route::get('/api/Sections/{id}', [SectionController::class, 'show']);

Route::middleware('auth:api','admin')->group(function () {

Route::post('/Sections', [SectionController::class, 'store']);
Route::post('/Sections/{id}', [SectionController::class, 'update']);
Route::delete('/Sections/{Section}', [SectionController::class, 'destroy']);

 });

// crud all stage //
Route::apiResource('/Stages', StageController::class) ;
Route::get('/api/Stages/{id}', [StageController::class, 'show']);

Route::middleware('auth:api','admin')->group(function () {

Route::post('/Stages', [StageController::class, 'store']);
Route::post('/Stages/{id}', [StageController::class, 'update']);
Route::delete('/Stages/{Stage}', [StageController::class, 'destroy']);

});

// crud all subjects //
Route::apiResource('/Subjects', SubjectController::class) ;
Route::get('/api/Subjects/{id}', [SubjectController::class, 'show']);

Route::middleware('auth:api','admin')->group(function () {

Route::post('/Subjects', [SubjectController::class, 'store']);
Route::post('/Subjects/{id}', [SubjectController::class, 'update']);
Route::delete('/Subjects/{Subject}', [SubjectController::class, 'destroy']);

});

// crud all tasks //
Route::apiResource('/Tasks', TaskController::class) ;
Route::get('/api/Tasks/{id}', [TaskController::class, 'show']);

Route::middleware('auth:api','admin')->group(function () {

Route::post('/Tasks', [TaskController::class, 'store']);
Route::post('/Tasks/{id}', [TaskController::class, 'update']);
Route::delete('/Tasks/{task}', [TaskController::class, 'destroy']);

 });

// crud all sumbission //
Route::apiResource('/Submissions', SubmissionController::class) ;
Route::get('/api/Submissions/{id}', [SubmissionController::class, 'show']);

Route::middleware('auth:api','admin')->group(function () {

Route::post('/Submissions', [SubmissionController::class, 'store']);
Route::post('/Submissions/{id}', [SubmissionController::class, 'update']);
Route::delete('/Submissions/{Submission}', [SubmissionController::class, 'destroy']);

 });

// crud all marks //
Route::apiResource('/Marks', MarkController::class) ;
Route::get('/api/Marks/{id}', [MarkController::class, 'show']);

Route::middleware('auth:api','admin')->group(function () {

Route::post('/Marks', [MarkController::class, 'store']);
Route::post('/Marks/{id}', [MarkController::class, 'update']);
Route::delete('/Marks/{Mark}', [MarkController::class, 'destroy']);

 });

