<?php

use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

// Publikus
Route::get('/', fn () => view('welcome'));
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth')->group(function () {

    Route::get('/kezdolap', function () {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    });
    Route::get('/logout', [UserController::class, 'logout']);

    // Diák és tanár is
    Route::get('/hirfolyam', [PostController::class, 'index']);
    Route::get('/hirfolyam/letrehozas', [PostController::class, 'create']);
    Route::get('/hirfolyam/{post}', [PostController::class, 'show']);
    Route::get('/jegyek/{classId}/{studentId}', [GradeController::class, 'show']);
    Route::get('/hianyzas', [AbsenceController::class, 'index']);
    Route::get('/hianyzasok', [AbsenceController::class, 'showAllAbsences'])->name('hianyzasok');

    Route::get('/uzenetek', [MessageController::class, 'index']);
    Route::get('/uzenet/uj', [MessageController::class, 'create']);
    Route::post('/uzenet', [MessageController::class, 'store']);
    Route::get('/uzenet/{id}', [MessageController::class, 'show']);

    // Csak tanár
    Route::middleware('role:teacher,admin')->group(function () {
        Route::get('/jegyek', [GradeController::class, 'index']);
        // Hírfolyam kezelése
        Route::get('/hirfolyam/letrehozas', [PostController::class, 'create']);
        Route::post('/hirfolyam', [PostController::class, 'store']);
        Route::get('/hirfolyam/szerkesztes/{post}', [PostController::class, 'edit']);
        Route::put('/hirfolyam/szerkeszt/{post}', [PostController::class, 'update']);
        Route::get('/hirfolyam/torles/{post}', [PostController::class, 'destroy']);

        // Jegyek kezelése
        Route::get('/jegyek/{id}', [GradeController::class, 'showClass']);
        Route::post('/jegyek/{id}', [GradeController::class, 'store']);
        Route::delete('/jegyek/delete/{id}', [GradeController::class, 'destroy']);
        Route::put('/jegyek/edit/{id}', [GradeController::class, 'update']);

        // Hiányzások kezelése
        Route::get('/hianyzas/create', [AbsenceController::class, 'create']);
        Route::get('/hianyzas/{lesson}', [AbsenceController::class, 'show']);
        Route::post('/hianyzas/{lesson}', [AbsenceController::class, 'store']);
        Route::post('/hianyzas/torles/{id}', [AbsenceController::class, 'destroy']);
        Route::get('/hianyzas/szerkeszt/{absence}', [AbsenceController::class, 'edit']);
        Route::put('/hianyzas/szerkeszt/{absence}', [AbsenceController::class, 'update']);
    });

    // Admin
    Route::get('/admin', [AdminController::class, 'index'])->middleware('role:admin');
    Route::get('/register', fn () => view('admin.register'))->middleware('role:admin');
    Route::post('/register', [UserController::class, 'store'])->middleware('role:admin');
});