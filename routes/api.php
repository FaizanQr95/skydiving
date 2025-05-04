<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// routes/api.php


//Route::post('/register', [ApiController::class, 'register']);
//Route::post('/login', [ApiController::class, 'login']);
//Route::get('/products', [ProductController::class, 'index']);


Route::post('/register', [ApiController::class, 'register']);
Route::post('/verify-otp', [ApiController::class, 'verifyOtp']);
Route::post('/resend-otp', [ApiController::class, 'resendOtp']);
Route::post('/login', [ApiController::class, 'login']);
//Route::post('/forgot-password', [ApiController::class, 'forgotPassword']);
Route::post('/change-password', [ApiController::class, 'changePassword']);
Route::post('/check-phone', [ApiController::class, 'checkPhoneNumber']);

//Route::get('/referral', [ApiController::class, 'getUserReferralDetail']);
Route::middleware('auth:sanctum')->get('/user-reward', [ApiController::class, 'userReward']);

Route::middleware('auth:sanctum')->get('/referral', [ApiController::class, 'getUserReferralDetail']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiController::class, 'logout']);
});
