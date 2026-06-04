<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('category', App\Http\Controllers\Api\CategoryController::class)->except(["create", "edit"]);
Route::resource('post', App\Http\Controllers\Api\PostController::class)->except(["create", "edit
"]);
