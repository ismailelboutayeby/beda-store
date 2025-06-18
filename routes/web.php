<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DesignerController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AtelierController;
use App\Http\Controllers\LogisticsController;

Route::get('/', function () {
    return view('home'); // This should be your custom homepage
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['role:designer'])->prefix('designer')->name('designer.')->group(function () {
    Route::get('/orders', [DesignerController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [DesignerController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/process', [DesignerController::class, 'process'])->name('orders.process');
});

Route::middleware(['role:warehouse_manager'])->prefix('warehouse')->name('warehouse.')->group(function () {
    Route::get('/orders', [WarehouseController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [WarehouseController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/validate', [WarehouseController::class, 'validateOrder'])->name('orders.validate');
});

Route::middleware(['role:atelier_manager'])->prefix('atelier')->name('atelier.')->group(function () {
    Route::get('/orders', [AtelierController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AtelierController::class, 'show'])->name('orders.assign');
    Route::post('/orders/{order}/assign', [AtelierController::class, 'storeTask'])->name('orders.assign.store');
    Route::post('/orders/{order}/complete', [AtelierController::class, 'markAsReady'])->name('orders.complete');
});

Route::get('/atelier/tasks/{task}/pdf', [AtelierController::class, 'exportTask'])->name('atelier.tasks.pdf');

Route::middleware(['role:logistic'])->prefix('logistics')->name('logistics.')->group(function () {
    Route::get('/orders', [LogisticsController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [LogisticsController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/assign', [LogisticsController::class, 'store'])->name('orders.store');
});

Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');
});
