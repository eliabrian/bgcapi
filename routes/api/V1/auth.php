<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;

Route::post('/login', LoginController::class)
    ->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
   Route::get('/logout', LogoutController::class)
    ->name('logout');
});
