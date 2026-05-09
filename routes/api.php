<?php

use App\Http\Controllers\SheetMusicController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/sheet-music', SheetMusicController::class)->middleware('auth:sanctum');
Route::apiResource('/tag', TagController::class)->middleware('auth:sanctum');
Route::get('/sheet-music/{id}/file', [SheetMusicController::class, 'getFile'])->middleware('auth:sanctum');

Route::get('/profile', [UserController::class, 'show'])->middleware('auth:sanctum');
