<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AuthController,
    VehicleController,
    RentalController,
    UserController
};

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Vehicles
    Route::get('/vehicles', [VehicleController::class, 'index']);
    Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show']);

    // Rentals
    Route::post('/rentals/start', [RentalController::class, 'start']);
    Route::post('/rentals/end/{rental}', [RentalController::class, 'end']);
    Route::get('/rentals/active', [RentalController::class, 'active']);

    // User
    Route::post('/deposit', [UserController::class, 'deposit']);
    Route::get('/transactions', [UserController::class, 'transactions']);
});
