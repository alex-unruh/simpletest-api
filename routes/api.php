<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReleaseController;

Route::post('/login', [AuthController::class, 'login'])->middleware('auth.basic');

//Route::middleware('auth:sanctum')->group(function () {
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/full-logout', [AuthController::class, 'fullLogout']);
Route::get('/refresh-token', [AuthController::class, 'refresh']);

// Users
Route::prefix('users')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}/show', 'show');
        Route::get('/{user}/is-busy', 'isBusy');
        Route::post('/store', 'store');
        Route::post('/{id}/update', 'update');
        Route::post('/{id}/delete', 'destroy');
    })->middleware('can:manage-users');
});

// Products
Route::prefix('products')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}/show', 'show');
        Route::get('/{user}/is-busy', 'isBusy');
        Route::post('/store', 'store');
        Route::post('/{id}/update', 'update');
        Route::post('/{id}/delete', 'destroy');
    });
});

// Releases
Route::prefix('releases')->group(function () {
    Route::controller(ReleaseController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}/show', 'show');
        Route::post('/store', 'store');
        Route::post('/{id}/update', 'update');
        Route::post('/{id}/delete', 'destroy');
    });
});
//});
