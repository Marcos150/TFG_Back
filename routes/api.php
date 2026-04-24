<?php

use App\Http\Controllers\SheetMusicController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/sheet-music', SheetMusicController::class);
Route::apiResource('/tag', TagController::class);
