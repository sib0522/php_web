<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TableController;
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
    return view('welcome');
});

Route::get("/", [IndexController::class, "index"]);
Route::get("/user", [UserController::class, "user"]);
Route::get("/account/register", [AccountController::class, "register"]);
Route::get("/account/login", [AccountController::class, "login"]);
Route::get("/account/password", [AccountController::class, "password"]);
Route::get("/account/delete", [AccountController::class, "delete"]);
Route::get("/file/resource", [FileController::class, "resource"]);
Route::get("/file/gallery", [FileController::class, "gallery"]);
Route::get("/table/:name", [TableController::class, "table_list"]);
Route::get("/table/admin/:name", [TableController::class, "table_detail"]);
