<?php

use App\Http\Controllers\SheetMusicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/sheet-music', SheetMusicController::class);
