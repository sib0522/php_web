<?php

use App\Services\GachaService;
use Illuminate\Support\Facades\Route;
use App\Services\AccountService;
use App\Services\PlayerService;

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


// 管理画面API
Route::group(['prefix'=>'account'], function() {
    Route::post('/login', [AccountService::class, 'AccountLoginService']);
    Route::post('/logout', [AccountService::class, 'AccountLogoutService']);
    Route::post('/signup', [AccountService::class, 'AccountSignupService']);
});

// ユーザーAPI
Route::group(['prefix'=>'player'], function() {
    Route::post('/create', [PlayerService::class, 'PlayerCreateService']);
});

// ガチャAPI
Route::post('/gacha', [GachaService::class, 'GachaService']);
