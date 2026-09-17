<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\EmployeeController;

// --- LOGIN ---

Route::post('/login', [AuthController::class, 'login']);

// --- SANCTUM ---

Route::middleware('auth:sanctum')->group(function () {
	
    // LOGOUT
	
    Route::post('/logout', [AuthController::class, 'logout']);

    // --- Product ---
	
	Route::get('/products', [ProductController::class, 'index']);
	Route::get('/products/{product}', [ProductController::class, 'show']);
	Route::post('/products', [ProductController::class, 'store']);
    Route::patch('/products/{product}', [ProductController::class, 'update']);
	Route::delete('/products/{product}', [ProductController::class, 'destroy']);

    // --- Category ---
    
    Route::get('/categories', [CategoryController::class, 'index']);
	Route::get('/categories/{category}', [CategoryController::class, 'show']);
	Route::post('/categories', [CategoryController::class, 'store']);
    Route::patch('/categories/{category}', [CategoryController::class, 'update']);
	Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    // --- InventoryItem ---

    Route::get('/inventory-items', [InventoryItemController::class, 'index']);
	Route::get('/inventory-items/{inventory_item}', [InventoryItemController::class, 'show']);
	Route::post('/inventory-items', [InventoryItemController::class, 'store']);
    Route::patch('/inventory-items/{inventory_item}', [InventoryItemController::class, 'update']);
	Route::delete('/inventory-items/{inventory_item}', [InventoryItemController::class, 'destroy']);

    // --- Employee ---
	
	Route::get('/employees', [EmployeeController::class, 'index']);
	Route::get('/employees/{employee}', [EmployeeController::class, 'show']);
	Route::post('/employees', [EmployeeController::class, 'store']);
    Route::patch('/employees/{employee}', [EmployeeController::class, 'update']);
	Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy']);
    
});