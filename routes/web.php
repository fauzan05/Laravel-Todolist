<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/ ', [HomeController::class, 'home']);
Route::controller(UserController::class)->group(function(){
    Route::get('/login', 'login')->middleware([AuthMiddleware::class]);
    Route::post('/login', 'auth')->middleware([AuthMiddleware::class]);
    Route::post('/logout', 'logout')->middleware([OnlyMemberMiddleware::class]); 
});

Route::controller(TodolistController::class)
->middleware([OnlyMemberMiddleware::class])->group(function(){
    Route::get('/todolist', 'show');
    Route::post('/todolist', 'add');
    Route::post('/todolist/{id}', 'remove');
});