<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('index');
})->name('home-page');

Route::get('/user/login', function () {
    return view('/pages/users/login');
});

Route::get('/user/register', function () {
    return view('/pages/users/register');
});


Route::post("/user/login", [UserController::class, 'login'])->name('login_user');
Route::post("/user/register", [UserController::class, 'register'])->name('register_user');

Route::get('/admin/login', function () {
    return view('/pages/admins/login');
});

Route::get('/admin/register', function () {
    return view('/pages/admins/register');
});


Route::post("/admin/login", [AdminController::class, 'login'])->name('login_admin');
Route::post("/admin/register", [AdminController::class, 'register'])->name('register_admin');
