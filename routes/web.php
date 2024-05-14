<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


/** UserController routs */
// Route::post('/register', [UserController::class, 'register']);
// Route::post('/login', [UserController::class, 'login']);
// Route::put('/profile', [UserController::class, 'updateProfile'])->middleware('auth:sanctum');

/** StudentController routs */
// Route::post('/learning-style', [StudentController::class, 'assessLearningStyle'])->middleware('auth');
// Route::post('/subjects', [StudentController::class, 'selectSubjects'])->middleware('auth');
// Route::get('/study-plan', [StudentController::class, 'viewStudyPlan'])->middleware('auth');
// Route::post('/practice-questions', [StudentController::class, 'attemptPracticeQuestions'])->middleware('auth');
// Route::get('/performance', [StudentController::class, 'trackPerformance'])->middleware('auth');
// Route::post('/feedback', [StudentController::class, 'receiveFeedback'])->middleware('auth');
// Route::get('/rewards', [StudentController::class, 'earnRewards'])->middleware('auth');

/** AdminController routs */
// Route::group(['middleware' => ['auth', 'admin']], function () {
//     Route::get('/subjects', [AdminController::class, 'manageSubjects']);
//     Route::post('/subjects', [AdminController::class, 'manageSubjects']);
//     Route::put('/subjects', [AdminController::class, 'manageSubjects']);
//     Route::delete('/subjects', [AdminController::class, 'manageSubjects']);

//     Route::get('/study-materials', [AdminController::class, 'manageStudyMaterials']);
//     Route::post('/study-materials', [AdminController::class, 'manageStudyMaterials']);
//     Route::put('/study-materials', [AdminController::class, 'manageStudyMaterials']);
//     Route::delete('/study-materials', [AdminController::class, 'manageStudyMaterials']);
// });