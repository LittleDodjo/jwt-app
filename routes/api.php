<?php

use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\Room\RoomController;
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


// маршрутиризация для работы с пользователем
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});


Route::controller(RoomController::class)->group(function (){
    Route::get('rooms', 'index');
    Route::get('room/{id}', 'GetRoom');
    Route::post('room/{id}/unbook', 'Unbook');
});

//Route::controller(TodoController::class)->group(function () {
//    Route::get('todos', 'index');
//    Route::post('todo', 'store');
//    Route::get('todo/{id}', 'show');
//    Route::put('todo/{id}', 'update');
//    Route::delete('todo/{id}', 'destroy');
//});
