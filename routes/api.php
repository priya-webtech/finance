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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




Route::group(['prefix' => 'fundoo'], function () {
    Route::resource('settings', App\Http\Controllers\API\Fundoo_\SettingsAPIController::class);
});






Route::group(['prefix' => 'admin'], function () {
    Route::resource('pages', App\Http\Controllers\API\Admin\PagesAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('states', App\Http\Controllers\API\Admin\StateAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('cities', App\Http\Controllers\API\Admin\CityAPIController::class);
});




Route::group(['prefix' => 'admin'], function () {
    Route::resource('carcompanies', App\Http\Controllers\API\Admin\CarcompanyAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('carmodels', App\Http\Controllers\API\Admin\CarmodelAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('caryears', App\Http\Controllers\API\Admin\CaryearAPIController::class);
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('offercodes', App\Http\Controllers\API\Admin\OffercodeAPIController::class);
});




Route::group(['prefix' => 'admin'], function () {
    Route::resource('staticdatas', App\Http\Controllers\API\Admin\StaticdataAPIController::class);
});
