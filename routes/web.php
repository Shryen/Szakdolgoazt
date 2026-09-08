<?php

use App\Models\User;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function(){
    return view('admin.register');
});

Route::get('/dashboard', function(){
    return view('dashboard');
});

Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);