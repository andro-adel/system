<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\website\homeController;
use App\Http\Controllers\website\userController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', [homeController::class, 'index']);

Route::post('/switch-lang', [homeController::class, 'switch_language']);

Route::post('/verifymail', [homeController::class, 'store']);

Route::get('/login', [userController::class, 'login_view']);

Route::get('/register', [userController::class, 'register_view']);

Route::post('/login', [userController::class, 'login']);

Route::post('/register', [userController::class, 'register']);

Route::post('/logout', [userController::class, 'logout']);

Route::get('/verifymail', [userController::class, 'verifymail']);

Route::get('/forgetpassword', [userController::class, 'forget_password']);

Route::post('/forgetpassword', [userController::class, 'reset_password_request']);

Route::get('/resetpassword', [userController::class, 'resetpassword']);

Route::post('/resetpassword', [userController::class, 'resetpassword_request']);

Route::get('/sign-in/facebook', [userController::class, 'signinfacebook']);

Route::get('/sign-in/google', [userController::class, 'signingoogle']);

Route::get('/sign-in/facebook/redirect', [userController::class, 'signinSocialredirect']);

Route::get('/sign-in/google/redirect', [userController::class, 'signinSocialredirect']);

