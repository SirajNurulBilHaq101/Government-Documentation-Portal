<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Activity\ActivityController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Document\DocumentController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// ─── Guest Routes ────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/sign-in', [AuthController::class, 'showSignIn'])->name('sign-in');
    Route::post('/sign-in', [AuthController::class, 'signIn'])->name('sign-in.post');
});

// ─── Authenticated Routes ─────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ── Dashboard (all roles) ────────────────────────────────────────────────
    Route::get('/', function () {
        $totalDocuments   = \App\Models\Document::count();
        $totalCategories  = \App\Models\Category::count();
        $activeUsers      = \App\Models\User::where('is_active', true)->count();
        $totalActivities  = \App\Models\ActivityLog::count();
        $recentDocuments  = \App\Models\Document::with('category')->latest()->take(5)->get();
        $recentActivities = \App\Models\ActivityLog::with('user', 'document')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalDocuments',
            'totalCategories',
            'activeUsers',
            'totalActivities',
            'recentDocuments',
            'recentActivities'
        ));
    });

    // ── Documents ────────────────────────────────────────────────────────────
    // All roles: view list, preview, download
    Route::get('documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('documents/{document}/preview', [DocumentController::class, 'preview'])->name('documents.preview');
    Route::get('documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::get('documents/{document}', [DocumentController::class, 'show'])->name('documents.show');

    // Admin & Staff: create, upload
    Route::middleware('role:staff')->group(function () {
        Route::get('documents/create', [DocumentController::class, 'create'])->name('documents.create');
        Route::post('documents', [DocumentController::class, 'store'])->name('documents.store');
        Route::get('documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
        Route::put('documents/{document}', [DocumentController::class, 'update'])->name('documents.update');
        Route::patch('documents/{document}', [DocumentController::class, 'update']);
    });

    // Admin only: delete
    Route::middleware('role:admin')->group(function () {
        Route::delete('documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    });

    // ── Categories ───────────────────────────────────────────────────────────
    // All roles: view list
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

    // Admin & Staff: can view only (staff) — create/edit/delete: admin only
    Route::middleware('role:admin')->group(function () {
        Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::patch('categories/{category}', [CategoryController::class, 'update']);
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // ── Activity Logs (admin only) ───────────────────────────────────────────
    Route::middleware('role:admin')->group(function () {
        Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
    });

    // ── User Management (admin only) ─────────────────────────────────────────
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });
});
