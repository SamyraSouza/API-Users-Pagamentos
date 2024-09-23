<?php

use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TesteController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;


    Route::get('/users', [UserController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::middleware('auth:sanctum')->group(function(){
        Route::get('/teste', [TesteController::class, 'index']);
        Route::get('/users/{user}', [UserController::class, 'show']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
    //Todas as rotas do resources numa mesma com o middleware no construtor
    Route::apiResource('invoices', InvoiceController::class);
