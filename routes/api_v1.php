<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'cars' => CarController::class,
]);

Route::post('cars/{car_id}/set_driver', 'CarController@setDriver')
    ->name('cars.setDriver');

Route::post('cars/{car_id}/unset_driver', 'CarController@unsetDriver')
    ->name('cars.unsetDriver');
