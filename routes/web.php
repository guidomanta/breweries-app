<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BreweryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'create'])->name('login');

Route::get('/breweries', [BreweryController::class, 'index'])->name('breweries')->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'destroy']);
