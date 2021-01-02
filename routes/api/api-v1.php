<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RoomTypeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('register', [RegisterController::class, 'register']);
//Route::post('login', [LoginController::class, 'login']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('roomType', RoomTypeController::class);
});

Route::get('test', function () {
    return "<b>My name is Ahmed Raed Siam - <small>120170736</small><i>V1</i></b>";
});
