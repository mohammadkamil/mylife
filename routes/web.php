<?php

use App\Http\Controllers\UserController;
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

Route::group(
    [

        'prefix'     => '/',
        'name'=>'life.'
    ],
    function ($router) {
        Route::get('', [UserController::class,"index"])->name("index");
        Route::get('index', [UserController::class,"index"])->name("index2");

        Route::get('login',  [UserController::class,"login"])->name("login");
        Route::get('register', [UserController::class,"register"])->name("register");
        Route::get('logout',  [UserController::class,"logout"])->name("logout");
        Route::get('profile', [UserController::class,"profile"])->name("profile");
        Route::get('refresh',  [UserController::class,"refresh"])->name("refresh");
    }
);
