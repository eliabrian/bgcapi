<?php

use App\Http\Controllers\Api\V1\Game\DestroyController;
use App\Http\Controllers\Api\V1\Game\ShowController;
use App\Http\Controllers\Api\V1\Game\IndexController;
use App\Http\Controllers\Api\V1\Game\StoreController;
use App\Http\Controllers\Api\V1\Game\UpdateController;
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

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post(
            uri: '/',
            action: StoreController::class,
        )->name('store');

        Route::put(
            uri: '/{id}',
            action: UpdateController::class,
        )->name('update');

        Route::delete(
            uri: '/{id}',
            action: DestroyController::class,
        )->name('delete');
    });
});
