<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ----------------------- ADMIN Panel API Route Section ----------------------- //
Route::middleware('auth')->group(function() {
    Route::post('/exam-paper-assigned-question-create-or-delete', [AdminControllers\ExamPaperController::class, 'exam_paper_assigned_question_create_or_delete']);
});

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/my-profile', [ClientControllers\API\ProfileController::class, 'my_profile']);
});
