<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Activity\ActivityController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Document\DocumentController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// ─── Guest Routes ─────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/sign-in', [AuthController::class, 'showSignIn'])->name('sign-in');
    Route::post('/sign-in', [AuthController::class, 'signIn'])->name('sign-in.post');
});

// ─── Authenticated Routes ──────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ── Dashboard (all roles) ──────────────────────────────────────────────────
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
    })->name('dashboard');

    // ── Documents ──────────────────────────────────────────────────────────────
    // PENTING: Route statis (create) HARUS didaftarkan sebelum route dinamis ({document})
    // agar Laravel tidak salah menganggap 'create' sebagai parameter {document}.

    // List (all roles)
    Route::get('documents', [DocumentController::class, 'index'])->name('documents.index');

    // Create form (admin & staff) — HARUS sebelum {document}
    Route::middleware('role:staff')->group(function () {
        Route::get('documents/create', [DocumentController::class, 'create'])->name('documents.create');
        Route::post('documents', [DocumentController::class, 'store'])->name('documents.store');
    });

    // Specific document routes — setelah route statis
    Route::get('documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    Route::get('documents/{document}/preview', [DocumentController::class, 'preview'])->name('documents.preview');
    Route::get('documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');

    // Edit (admin & staff) — HARUS sebelum PUT/PATCH dengan {document}
    Route::middleware('role:staff')->group(function () {
        Route::get('documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
        Route::put('documents/{document}', [DocumentController::class, 'update'])->name('documents.update');
        Route::patch('documents/{document}', [DocumentController::class, 'update']);
    });

    // Delete (admin only)
    Route::middleware('role:admin')->group(function () {
        Route::delete('documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    });

    // ── Categories ─────────────────────────────────────────────────────────────
    // PENTING: Route statis (create) HARUS didaftarkan sebelum route dinamis ({category}).

    // List (all roles)
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');

    // Create form (admin only) — HARUS sebelum {category}
    Route::middleware('role:admin')->group(function () {
        Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    });

    // Specific category routes — setelah route statis
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

    // Edit / delete (admin only)
    Route::middleware('role:admin')->group(function () {
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::patch('categories/{category}', [CategoryController::class, 'update']);
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // ── Activity Logs (admin only) ─────────────────────────────────────────────
    Route::middleware('role:admin')->group(function () {
        Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
    });

    // ── User Management (admin only) ───────────────────────────────────────────
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });
});
