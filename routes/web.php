<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Student\GradesController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes Student
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('profile', [\App\Http\Controllers\Student\ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/edit', [\App\Http\Controllers\Student\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/update', [\App\Http\Controllers\Student\ProfileController::class, 'update'])->name('profile.update');
    Route::get('grades', [GradesController::class, 'index'])->name('grades.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour les administrateurs et assistants
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        // Routes de gestion des utilisateurs (uniquement pour les administrateurs)
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/users', [UserController::class, 'store'])->name('users.store');
            Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
            Route::post('/users/destroy-all-students', [UserController::class, 'destroyAllStudents'])->name('users.destroy-all-students');
            Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
        });

        // Routes de gestion des notes (pour les administrateurs et assistants)
        Route::middleware(['role:admin,assistant'])->group(function () {
            Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
            Route::get('/grades/create', [GradeController::class, 'create'])->name('grades.create');
            Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');
            Route::get('/grades/{grade}/edit', [GradeController::class, 'edit'])->name('grades.edit');
            Route::put('/grades/{grade}', [GradeController::class, 'update'])->name('grades.update');
            Route::delete('/grades/{grade}', [GradeController::class, 'destroy'])->name('grades.destroy');
            Route::get('/grades/upload', [GradeController::class, 'uploadForm'])->name('grades.uploadForm');
            Route::post('/grades/import', [GradeController::class, 'import'])->name('grades.import');
            Route::get('/grades/search', [GradeController::class, 'search'])->name('grades.search');
        });

        // Routes pour les logs (uniquement pour les administrateurs)
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/logs', [App\Http\Controllers\Admin\LogController::class, 'index'])->name('logs.index');
            Route::get('/logs/download', [App\Http\Controllers\Admin\LogController::class, 'download'])->name('logs.download');
        });

        // Routes pour le profil
        Route::middleware(['role:admin,assistant'])->group(function () {
            Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
            Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
        });
    });
});

require __DIR__.'/auth.php';
