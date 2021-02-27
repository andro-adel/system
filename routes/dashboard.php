<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\authController;
use App\Http\Controllers\admin\dashboardContoller;
use App\Http\Controllers\admin\addressController;
use App\Http\Controllers\admin\materialesController;
use App\Http\Controllers\admin\customerController;
use App\Http\Controllers\admin\Report\ReportController;
use App\Http\Controllers\admin\adminController;




// login 
Route::get('/admin/login', [authController::class, 'login'])->middleware('guest')->name("login");
Route::post('/admin/login', [authController::class, 'loginAdmin'])->middleware('guest');
Route::get('/logout', [authController::class, 'logout'])->middleware('auth');




// admins routes
Route::middleware('auth', 'users')->group(function () {

    Route::prefix('admin')->group(function () {

        // routes to both admins & super admins
        Route::get('', [dashboardContoller::class, 'index']);

        Route::resource('address', addressController::class);

        Route::resource('material', materialesController::class);

        Route::get('profile', [dashboardContoller::class, 'profile']);

        Route::post('profile', [dashboardContoller::class, 'updateProfile']);

        Route::post('save-address', [dashboardContoller::class, 'saveAddress']);

        Route::post('delete-profile-address/{id}', [dashboardContoller::class, 'delete']);

        Route::resource('manage-users', customerController::class);

        // super admins routes only
        Route::middleware('super')->group(function () {

            Route::get('reports', [ReportController::class, 'index']);

            Route::post('order-reports', [ReportController::class, 'orderReports']);
            
            Route::resource('manage-admins', adminController::class);

            Route::post('delete-users/{id}', [customerController::class, 'delete']);

            Route::post('delete-address/{id}', [addressController::class, 'delete']);

            Route::post('delete-material/{id}', [materialesController::class, 'delete']);

            Route::get('material/edit', [materialesController::class, "edit"]);

            Route::post('assign-variance-attributes/{id}', [materialesController::class, 'assignAttributes']);


        });
    });
});