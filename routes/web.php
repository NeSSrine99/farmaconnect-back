<?php

use App\Http\Controllers\Admin\ConsultationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PrescriptionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubscriptionController;
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
    Route::post('orders/{id}/status', [OrderController::class, 'updateStatus'])
        ->name('admin.orders.updateStatus');
    // AJAX
    Route::get('orders/{id}/items', [OrderController::class, 'items'])
        ->name('admin.orders.items');

    Route::get('prescriptions', [PrescriptionController::class, 'index'])->name('admin.prescriptions');
    Route::post('prescriptions/{id}/status', [PrescriptionController::class, 'updateStatus'])
        ->name('admin.prescriptions.updateStatus');
    Route::resource('users', UserController::class)->names('admin.users');
    Route::get('prescriptions/{id}/create-order', [PrescriptionController::class, 'createOrder'])
        ->name('admin.prescriptions.createOrder');

    Route::post('prescriptions/{id}/store-order', [PrescriptionController::class, 'storeOrder'])
        ->name('admin.prescriptions.storeOrder');
    Route::get('prescriptions/count', [PrescriptionController::class, 'count']);


    Route::get('/consultations', [ConsultationController::class, 'index'])->name('admin.consultations');
    Route::get('/consultations/{id}', [ConsultationController::class, 'show'])->name('admin.consultations.show');
    Route::post('/consultations/{id}/reply', [ConsultationController::class, 'reply'])->name('admin.consultations.reply');
    Route::delete('/consultations/{id}', [ConsultationController::class, 'destroy'])->name('admin.consultations.destroy');


    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('admin.subscriptions');
    Route::get('/subscriptions/{id}', [SubscriptionController::class, 'show'])->name('admin.subscriptions.show');
    Route::delete('/subscriptions/{id}', [SubscriptionController::class, 'destroy'])->name('admin.subscriptions.destroy');

    Route::get('/admin/team', [UserController::class, 'team'])->name('admin.team');
});





//  
Route::apiResource('products', ApiProductController::class);
Route::apiResource('categories', CategoryController::class);

Route::get('orders', [ApiOrderController::class, 'index']);
Route::post('orders', [ApiOrderController::class, 'store']);
Route::put('orders/{id}/status', [ApiOrderController::class, 'updateStatus']);

Route::post('prescriptions', [ApiPrescriptionController::class, 'store']);
Route::put('prescriptions/{id}/review', [ApiPrescriptionController::class, 'review']);
