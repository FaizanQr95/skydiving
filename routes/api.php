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
Route::post('/profile', [ApiController::class, 'profile']);
//Route::post('/avatar', [ApiController::class, 'uploadAvatar']);
//Route::post('/forgot-password', [ApiController::class, 'forgotPassword']);
Route::post('/change-password', [ApiController::class, 'changePassword']);
Route::post('/forgot-password', [ApiController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [ApiController::class, 'resetPassword']);
Route::post('/check-phone', [ApiController::class, 'checkPhoneNumber']);

//Route::get('/referral', [ApiController::class, 'getUserReferralDetail']);
Route::middleware('auth:sanctum')->post('/update-profile', [ApiController::class, 'updateProfile']);
Route::middleware('auth:sanctum')->get('/user-reward', [ApiController::class, 'userReward']);
Route::middleware('auth:sanctum')->post('/support-mail', [ApiController::class, 'supportMail']);
Route::middleware('auth:sanctum')->post('/delete-user', [ApiController::class, 'deleteUser']);

Route::middleware('auth:sanctum')->get('/referral', [ApiController::class, 'getUserReferralDetail']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiController::class, 'logout']);
});

// User-facing support chat routes (require user authentication)
Route::middleware('auth:sanctum')->prefix('support-chat')->group(function () {
    Route::post('/send', [ApiController::class, 'userSendMessage']);
    Route::get('/messages', [ApiController::class, 'getUserSupportMessages']);
});

// Admin-facing support chat routes (require admin authentication)
// You might have a separate 'admin' middleware group
//Route::middleware('auth:sanctum')->prefix('support-chat')->group(function () {
Route::prefix('support-chat')->group(function () {
    Route::post('/send-to-user', [ApiController::class, 'adminSendMessage']);
    Route::get('/messages/{targetUserId}', [ApiController::class, 'getAdminUserMessages']);
});

