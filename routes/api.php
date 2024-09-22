<?php

use App\Core\UseCases\GachaUsecase;
use App\Services\GachaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\AccountService;
use App\Services\PlayerService;
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


Route::post('/account/login', [AccountService::class, 'AccountLoginService']);
Route::post('/account/logout', [AccountService::class, 'AccountLogoutService']);
Route::post('/account/signup', [AccountService::class, 'AccountSignupService']);

Route::get('/ping', function() {
    return response()->json("hello");
});

Route::post('/player/create', [PlayerService::class, 'PlayerCreateService']);

Route::post('/gacha', [GachaService::class, 'GachaService']);
