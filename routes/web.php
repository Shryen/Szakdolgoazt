<?php

use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kezdolap', function(){
    $user = Auth::user();
    return view('dashboard', compact('user'));
});

// Auth
Route::get('/register', function(){
    return view('admin.register');
});
Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

// Admin
Route::get('/admin', [AdminController::class, 'index']);

// Post
Route::get('/hirfolyam', [PostController::class, 'index']);
Route::get('/hirfolyam/letrehozas', [PostController::class, 'create']);
Route::post('/hirfolyam', [PostController::class,'store']);
Route::get('/hirfolyam/{post}', [PostController::class, 'show']); //{post} paraméterként mert nem id alapján, hanem model alapján keresünk
Route::get('/hirfolyam/szerkesztes/{post}', [PostController::class, 'edit']);
Route::put('/hirfolyam/szerkeszt/{post}', [PostController::class, 'update']);
Route::get('/hirfolyam/torles/{post}', [PostController::class, 'destroy']);


// Grades
Route::get('/jegyek', [GradeController::class, 'index']);
Route::get('/jegyek/{id}', [GradeController::class, 'showClass']);
Route::get('/jegyek/{classId}/{studentId}', [GradeController::class, 'show']);