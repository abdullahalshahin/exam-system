<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ----------------------- public page route section ----------------------- //
Route::get('/', [PublicPageController::class, 'index']);
Route::get('/faqs', [PublicPageController::class, 'faqs']);
Route::get('/about-us', [PublicPageController::class, 'about_us']);
Route::get('/contact-us', [PublicPageController::class, 'contact_us']);

Route::middleware('auth')->group(function() {
    // ----------------------- ADMIN panel route section ----------------------- //
    Route::prefix('admin-panel/dashboard')->group(function() {
        Route::get('/', [AdminControllers\DashboardController::class, 'index']);

        Route::resource('subjects', AdminControllers\SubjectController::class);
        Route::resource('questions', AdminControllers\QuestionController::class);
        Route::resource('exam-papers', AdminControllers\ExamPaperController::class);

        Route::get('exam-results', [AdminControllers\ResultController::class, 'index']);
        Route::get('exam-results/{exam_paper}', [AdminControllers\ResultController::class, 'show']);
        Route::get('exam-results/{exam_paper}/exam-participants/{exam_participant}', [AdminControllers\ResultController::class, 'show_exam_participant']);

        Route::resource('users', AdminControllers\UserController::class); 
        Route::resource('students', AdminControllers\StudentController::class); 
    });

    // ----------------------- CLIENT panel route section ----------------------- //
    Route::prefix('client-panel/dashboard')->group(function() {
        Route::get('/', [ClientControllers\DashboardController::class, 'index']);

        Route::get('exams', [ClientControllers\ExamController::class, 'index']);
        Route::get('exams/{exam}', [ClientControllers\ExamController::class, 'create']);
        Route::post('exams/{exam}', [ClientControllers\ExamController::class, 'store']);
        Route::get('exams/{exam}/result', [ClientControllers\ExamController::class, 'show_result']);

        Route::get('my-account', [ClientControllers\ProfileController::class, 'my_account']);
        Route::get('my-account-edit', [ClientControllers\ProfileController::class, 'my_account_edit']);
        Route::put('my-account-update', [ClientControllers\ProfileController::class, 'my_account_update']);
    });
});

require __DIR__.'/auth.php';
