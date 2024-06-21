<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(ApiController::class)->group(function () {
    Route::get('/users', 'index');
    Route::get('/users/{user}', 'show');
    Route::post('/users', 'store');
    Route::put('/users/{user}', 'update');
    Route::delete('/users/{user}', 'destroy');

});

Route::controller(ApiiController::class)->group(function () {
    Route::get('/employees', 'index');
    Route::get('/employees/{employee}', 'show');
    Route::post('/employees', 'store');
    Route::put('/employees/{employee}', 'update');
    Route::delete('/employees/{employee}', 'destroy');
});



