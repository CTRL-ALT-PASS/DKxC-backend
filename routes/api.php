<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

    
    //4 cat
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    //4 inv
    Route::get('/inventory-items', [InventoryItemController::class, 'index']);
    Route::get('/inventory-items/{id}', [InventoryItemController::class, 'show']);
    Route::post('/inventory-items', [InventoryItemController::class, 'store']);
    Route::put('/inventory-items/{id}', [InventoryItemController::class, 'update']);
    Route::delete('/inventory-items/{id}', [InventoryItemController::class, 'destroy']);

    //5 products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
