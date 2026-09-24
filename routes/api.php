<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomisationGroupController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCustomisationController;
use App\Http\Controllers\ProductSizeController;
use Illuminate\Support\Facades\Route;

// Product
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/products/{product}/sizes', [ProductSizeController::class, 'index']);
Route::get('/products/{product}/customisations', [CustomisationGroupController::class, 'forProduct']);

// Customisation
Route::get('/customisations', [CustomisationGroupController::class, 'index']);

// Category
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

// InventoryItem
Route::get('/inventory-items', [InventoryItemController::class, 'index']);
Route::get('/inventory-items/{inventory_item}', [InventoryItemController::class, 'show']);

// --- LOGIN ---
Route::post('/login', [AuthController::class, 'login']);

// --- SANCTUM ---
Route::middleware('auth:sanctum')->group(function () {

    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout']);

    // --- Product ---
    Route::post('/products', [ProductController::class, 'store']);
    Route::patch('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);

    // --- ProductSize ---
    Route::post('/products/{product}/sizes', [ProductSizeController::class, 'store']);
    Route::patch('/product-sizes/{productSize}', [ProductSizeController::class, 'update']);
    Route::delete('/product-sizes/{productSize}', [ProductSizeController::class, 'destroy']);

    // --- CustomisationGroup ---
    Route::post('/customisations', [CustomisationGroupController::class, 'store']);
    Route::patch('/customisations/{group:group_id}', [CustomisationGroupController::class, 'update']);
    Route::delete('/customisations/{group:group_id}', [CustomisationGroupController::class, 'destroy']);

    // --- Product ↔ Group linking ---
    Route::post('/products/{product}/customisations', [ProductCustomisationController::class, 'store']);
    Route::delete('/products/{product}/customisations/{groupId}', [ProductCustomisationController::class, 'destroy']);

    // --- Category ---
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::patch('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    // --- InventoryItem ---
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
