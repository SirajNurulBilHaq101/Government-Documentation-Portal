<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('/sign-in', [AuthController::class, 'showSignIn'])
        ->name('sign-in');

    Route::post('/sign-in', [AuthController::class, 'signIn'])
        ->name('sign-in.post');
});

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Category Routes
    Route::resource('categories', \App\Http\Controllers\Category\CategoryController::class);

    // Document Routes
    Route::get('documents/{document}/preview', [\App\Http\Controllers\Document\DocumentController::class, 'preview'])->name('documents.preview');
    Route::get('documents/{document}/download', [\App\Http\Controllers\Document\DocumentController::class, 'download'])->name('documents.download');
    Route::resource('documents', \App\Http\Controllers\Document\DocumentController::class);

    // Activity Route
    Route::get('activities', [\App\Http\Controllers\Activity\ActivityController::class, 'index'])->name('activities.index');
});
