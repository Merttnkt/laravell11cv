<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;



Route::group(['prefix' => 'auth', 'as' => 'auth.'], function (){
    Route::post('login', [UserController::class,'login']);
    Route::post('register', [UserController::class,'register']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

});
