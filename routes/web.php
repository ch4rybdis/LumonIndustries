<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect('/login');
});


Route::get('/deneme',[Controller::class,'deneme']);

Route::group(['middleware' => 'employee.data'], function () {
    Route::get('/products', [ProductController::class, 'viewProducts'])->name('products');
    Route::get('/inventory', [InventoryController::class, 'viewInventory'])->name('inventory');
    Route::get('/orders', [OrderController::class, 'viewOrders'])->name('orders');
    Route::get('/dashboard', [AuthController::class, 'viewDashboard'])->name('dashboard');
    Route::get('/profile',[AuthController::class,'viewProfile'])->name('profile');
    Route::put('/update-stock/{id}', [InventoryController::class, 'updateStock'])->name('updateStock');
    Route::post('/products/add', [ProductController::class,'addProduct'])->name('addProduct');
    Route::put('/products/{id}/edit', [ProductController::class, 'update'])->name('editProduct');
    Route::put('/update-image/{id}', [ProductController::class, 'updateImage'])->name('updateImage');
    Route::delete('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('changePassword');
    Route::post('/change-salary/{id}', [AuthController::class, 'changeSalary'])->name('changeSalary');

});

Route::get('/location', [ProductController::class, 'showLocation'])->name('location');




