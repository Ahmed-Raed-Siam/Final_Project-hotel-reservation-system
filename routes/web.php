<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\RoomController;
use App\Http\Controllers\Dashboard\RoomTypeController;
use App\Http\Controllers\Dashboard\RoomTypeTrashController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\UserRoleController;
use App\Http\Controllers\Dashboard\UserTrashController;
use App\Http\Controllers\HomeController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::name('dashboard.')->middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::patch('users/trash/{user_id}', [UserTrashController::class, 'restore'])->name('users.trash.restore');

    Route::name('users')->resource('users/trash', UserTrashController::class)->parameters([
        'trash' => 'user_id'
    ])->only([
        'index', 'show', 'destroy'
    ]);

    Route::name('users')->resource('users/roles', UserRoleController::class)->parameters([
        'role' => 'user_role'
    ]);

    Route::patch('rooms/types/trash/{room_type}', [RoomTypeTrashController::class, 'restore'])->name('rooms.types.trash.restore');

    Route::name('rooms.types')->resource('rooms/types/trash', RoomTypeTrashController::class)->parameters([
        'trash' => 'room_type'
    ])->only([
        'index', 'show', 'destroy'
    ]);

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::name('rooms')->resource('rooms/types', RoomTypeController::class);
    Route::resource('rooms', RoomController::class);

});
