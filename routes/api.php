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

// работа с комнатами
//маршруты для работы с комнатами
Route::controller(RoomController::class)->group(function (){
    Route::get('rooms', 'index');
    Route::get('room/{id}', 'GetRoom');
    Route::delete('room/{id}/unbook', 'Unbook');
    Route::post('room/{id}/book', 'Book');
    Route::patch('room/{id}/update/status', 'UpdateStatus');
    Route::patch('room/{id}/update/date', 'UpdateArriveDate');

});


