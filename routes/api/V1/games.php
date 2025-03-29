<?php

use App\Http\Controllers\Api\V1\Game\ShowController;
use App\Http\Controllers\Api\V1\Game\IndexController;
use Illuminate\Support\Facades\Route;

Route::name('games.')->group(function () {
    Route::get(
        uri: '/',
        action: IndexController::class,
    )->name('index');

    Route::get(
        uri: '/{id}',
        action: ShowController::class,
    )->name('show');
});
