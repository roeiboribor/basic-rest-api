<?php

use App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION - ROUTES
|--------------------------------------------------------------------------
|
| Here is where authentication related routes
|
*/

Route::post('register', [V1\Auth\RegisterController::class, 'store']);
Route::post('login', [V1\Auth\LoginController::class, 'store']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
    Route::delete('logout', [V1\Auth\LoginController::class, 'destroy']);
});
