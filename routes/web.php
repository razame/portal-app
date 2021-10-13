<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\RegisterController;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    return redirect()->route('getLogin');
});

Route::get('/register', [RegisterController::class, 'showRegisterPage'])->name('getRegister');
Route::post('/register', [RegisterController::class, 'register'])->name('postRegister');

Route::get('/login', [LoginController::class, 'showLoginPage'])->name('getLogin');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/home', [HomeController::class, 'home'])->name('home')->middleware('signed');

Route::middleware(['checkApiAuth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'profileOverview'])->name('profileOverview');
    Route::get('/email-settings', [ProfileController::class, 'emailSettings'])->name('emailSettings');
    Route::post('/change-email', [ProfileController::class, 'changeEmail'])->name('changeEmail');




});
