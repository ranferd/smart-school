<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CommunicationController;
use App\Http\Controllers\Api\V1\UserController;
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

Route::group(['prefix' => '/v1', 'as' => 'api.'], function () {
    Route::post('sign-up', [AuthController::class, 'signUp']);
    Route::post('login', [AuthController::class, 'login']);
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::group(['middleware' => 'role:school-admin'], function () {
            Route::get('users', [UserController::class, 'index']);
            Route::post('invite', [UserController::class, 'invite']);
            Route::get('user/{id}/delete', [UserController::class, 'delete']);
        });
        Route::get('teachers', [UserController::class, 'teachers'])->middleware('role:teacher');
        Route::get('students', [UserController::class, 'students'])->middleware('role:teacher,student');
        Route::get('chat/{user_id}', [CommunicationController::class, 'chat'])->middleware('role:teacher,student');
        Route::post('chat', [CommunicationController::class, 'store'])->middleware('role:teacher,student');
    });
});
