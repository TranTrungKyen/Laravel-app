<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/user/login', [UserController::class, 'showLoginForm'])->name('login-form');
Route::get('/user/register', [UserController::class, 'showRegisterForm'])->name('register-form');
Route::get('/user/logout', [UserController::class, 'logout'])->name('logout');

Route::post("/user/login", [UserController::class, 'login'])->name('login_user');
Route::post("/user/register", [UserController::class, 'register'])->name('register_user');


Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('login-admin-form');
Route::middleware(["permiss"])->group(function() {
    Route::middleware(["permissAdmins"])->group(function(){
        Route::get('/admin/create', [AdminController::class, 'create'])->name('create-user');
        Route::get('/admin/update', [AdminController::class, 'update'])->name('update-user');
        Route::get('/admin/delete', [AdminController::class, 'delete'])->name('delete-user');
    });
    Route::get('/admin/detail', [AdminController::class, 'details'])->name('detail-user');
    Route::get('/admin/list', [AdminController::class, 'displayListUser'])->name('list-user');
});
Route::get('/admin/register', [AdminController::class, 'showRegisterForm'])->name('register-admin-form');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('logout-admin');

Route::post("/admin/login", [AdminController::class, 'login'])->name('login_admin');
Route::post("/admin/register", [AdminController::class, 'register'])->name('register_admin');


