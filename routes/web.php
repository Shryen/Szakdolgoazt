<?php

use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function(){
    return view('admin.register');
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

// Admin
Route::get('/admin', [AdminController::class, 'index']);

// Post
Route::get('/hirfolyam', [PostController::class, 'index']);
Route::get('/hirfolyam/letrehozas', [PostController::class, 'create']);
Route::post('/hirfolyam', [PostController::class,'store']);