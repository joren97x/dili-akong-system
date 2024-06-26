<?php

use App\Models\Food;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SalesController;

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

Route::get('/', function () {
    return view('Student.index');
});

Route::get('/about', function () {
    return view('Student.about');
});


Route::middleware(['admin'])->group(function() {
    Route::put('/admin/complete-order/{order}', [OrderController::class, 'update']);
    Route::put('/admin/change-status/{food}', [FoodController::class, 'update_food_status']);
    Route::put('/admin/update-order/{order}', [OrderController::class, 'update']);
    Route::get('/admin/add-foods', [FoodController::class, 'create']);
    Route::get('/admin/edit-food/{food}', [FoodController::class, 'edit']);
    Route::get('/admin/sales-report', [SalesController::class, 'sales_report']);
    Route::get('/admin/view-foods', [FoodController::class, 'index']);
    Route::get('/admin/delete-food/{food}', [FoodController::class, 'delete']);
    Route::delete('/admin/delete-order/{order}', [OrderController::class, 'destroy']);
    Route::post('/admin/update-food/{food}', [FoodController::class, 'update']);
    Route::post('/admin/delete-food/{food}', [FoodController::class, 'destroy']);
    Route::get('/admin/order-history', [OrderController::class, 'order_history']);
    // Route::get('/admin/sales-report', [OrderController::class, 'sales_report']);
    Route::get('/admin/pending-orders', [OrderController::class, 'pending_orders']);
    Route::get('/admin/ready-orders', [OrderController::class, 'ready_orders']);
    Route::get('/admin/all-students', [UserController::class, 'all_students']);
    Route::get('/admin/all-admins', [UserController::class, 'all_admins']);
    Route::put('/admin/update-order-status', [OrderController::class, 'update_order_status']);
    Route::post('/add-food', [FoodController::class, 'store']);

});


Route::get('/contact-us', function () {
    return view('Student.contact-us');
});

Route::middleware(['student'])->group(function() {

    Route::get('/student/food-zone', [FoodController::class, 'index_student']);
    Route::get('/student/food-zone/search', [FoodController::class, 'index_student_search']);
    Route::get('/student/cart', [CartController::class, 'index']);
    Route::post('/student/payment', [CartController::class, 'payment']);
    Route::delete('/student/delete-food/{food}', [CartController::class, 'destroy']);
    Route::post('/student/confirm-payment', [CartController::class, 'confirm_payment']);
    Route::post('/student/add-to-cart', [CartController::class, 'store']);
    Route::get('/student/order-history', [OrderController::class, 'order']);

});

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/student/sign-up', [AuthController::class, 'student_sign_up']);
Route::post('/student/sign-up', [AuthController::class, 'store']);

Route::get('/admin/sign-in', [AuthController::class, 'admin_sign_in']);
Route::post('/admin/sign-in', [AuthController::class, 'login']);

Route::get('/student/sign-in', [AuthController::class, 'student_sign_in']);
Route::post('/student/sign-in', [AuthController::class, 'login']);
