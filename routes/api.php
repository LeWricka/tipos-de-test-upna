<?php

use App\Infrastructure\Controllers\GetSpecialUsers\GetSpecialUsersController;
use App\Infrastructure\Controllers\GetStatusController;
use App\Infrastructure\Controllers\GetUserController;
use App\Infrastructure\Controllers\GetUsers\GetUsersController;
use App\Infrastructure\Controllers\UserIsEarlyAdopterController;
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


Route::get('/status', GetStatusController::class);
Route::get('/user/early-adopter/{userEmail}', UserIsEarlyAdopterController::class);
Route::get('/users/special-users', GetSpecialUsersController::class);
Route::get('/users/{userEmail}', GetUserController::class);
Route::get('/users', GetUsersController::class);
<<<<<<< Updated upstream
Route::get('/user/early-adopter/{userEmail}', UserIsEarlyAdopterController::class);
=======
>>>>>>> Stashed changes
