<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\UserService;
use MessagePack\Packer;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::post('/user/login', [UserService::class, 'UserLoginService']);
Route::post('/user/logout', [UserService::class, 'UserLogoutService']);
Route::post('/user/signup', [UserService::class, 'UserSignupService']);

Route::get('/ping', function() {
    return response()->json("hello");
});
