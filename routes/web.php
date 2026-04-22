<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PrescriptionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController as ApiOrderController;
use App\Http\Controllers\Api\PrescriptionController as ApiPrescriptionController;
use App\Http\Controllers\Api\ProductController as ApiProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.layout.layout');
});



Route::prefix('admin')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('products', ProductController::class)->names('admin.products');

    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::get('orders/{id}/{status}', [OrderController::class, 'updateStatus']);

    Route::get('prescriptions', [PrescriptionController::class, 'index'])->name('admin.prescriptions');
    Route::get('prescriptions/{id}/{status}', [PrescriptionController::class, 'updateStatus']);
    Route::resource('users', UserController::class)->names('admin.users');
    
});





//  
Route::apiResource('products', ApiProductController::class);
Route::apiResource('categories', CategoryController::class);

Route::get('orders', [ApiOrderController::class, 'index']);
Route::post('orders', [ApiOrderController::class, 'store']);
Route::put('orders/{id}/status', [ApiOrderController::class, 'updateStatus']);

Route::post('prescriptions', [ApiPrescriptionController::class, 'store']);
Route::put('prescriptions/{id}/review', [ApiPrescriptionController::class, 'review']);
