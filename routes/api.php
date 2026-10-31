<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\api\SiswaApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('siswa', SiswaApiController::class);

Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
  Route::post('/logout', [AuthApiController::class, 'logout']);
  Route::apiResource('siswa', SiswaApiController::class);
});
