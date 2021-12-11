<?php


use App\Http\Controllers\API\Auth\AuthenticatedSessionController;
use App\Http\Controllers\API\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest')
                ->name('api.register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest')
                ->name('api.login');
