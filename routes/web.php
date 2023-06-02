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
    });

    // ----------------------- CLIENT panel route section ----------------------- //
    Route::prefix('client-panel/dashboard')->group(function() {
        Route::get('/', [ClientControllers\DashboardController::class, 'index']);

        Route::get('profile', [ClientControllers\ProfileController::class, 'profile']);
        Route::get('profile-edit', [ClientControllers\ProfileController::class, 'profile_edit']);
        Route::get('profile-update', [ClientControllers\ProfileController::class, 'profile_update']);
    });
});

require __DIR__.'/auth.php';
