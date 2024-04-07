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
// Route::post('login', [V1\AuthenticatedController::class, 'store']);

// Route::group(['middleware' => ['auth:api']], function () {
//     Route::get('profile', [V1\ProfileController::class, 'profile']);
//     Route::post('logout', [V1\AuthenticatedController::class, 'destroy'])->name('logout');
// });