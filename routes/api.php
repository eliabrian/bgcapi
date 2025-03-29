<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('tags')->group(
    base_path('routes/api/V1/tags.php'),
);

Route::prefix('difficulties')->group(
    base_path('routes/api/V1/difficulties.php'),
);

Route::prefix('games')->group(
    base_path('routes/api/V1/games.php'),
);

Route::prefix('auth')->group(
    base_path('routes/api/V1/auth.php'),
);
