<?php

use App\Http\Controllers\Api\V1\Tag\IndexController;
use App\Http\Controllers\Api\V1\Tag\ShowController;
use App\Http\Controllers\Api\V1\Tag\StoreController;
use Illuminate\Support\Facades\Route;

Route::name('tags.')->group(function () {
    Route::get(
        uri: '/',
        action: IndexController::class,
    )->name('index');

    Route::get(
        uri: '/{id}',
        action: ShowController::class,
    )->name('show');


    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/', StoreController::class)
        ->name('store');
    });
});
