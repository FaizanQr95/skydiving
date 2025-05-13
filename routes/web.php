<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', function () {
   return "Welcome to Sky Diving";
});
Route::middleware('guest:admin')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
});

// Authenticated admin routes
Route::middleware('auth:admin')->group(function () {
//    Route::get('/admin/dashboard', function () {
//        return view('admin.dashboard');
//    })->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/user-management', [AdminController::class,'userManagement'])->name('admin.user_management');

//    Sqaure Customers
    Route::get('/admin/customer', [AdminController::class, 'fetchCustomer'])->name('admin.fetch_customer.');

    Route::get('/admin/customer_support', [AdminController::class, 'customerSupport'])->name('admin.customer_support.');


    Route::get('/admin/fetch_customer', [AdminController::class,'customer'])->name('admin.customer');
    Route::get('/admin/reward-management', [AdminController::class,'rewardManagement'])->name('admin.reward_management');

    Route::get('/admin/referral-management', [AdminController::class,'referralManagement'])->name('admin.user_referral');
    Route::post('admin/assign-reward', [AdminController::class, 'assignReward'])->name('admin.assign_reward');
    Route::put('/admin/update-reward', [AdminController::class, 'updateReward'])->name('admin.update_reward');

    Route::post('admin/update-referral-status', [AdminController::class, 'updateStatus'])->name('admin.update_referral_status');

    Route::get('/admin/profile', [AdminController::class,'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminController::class,'adminProfileUpdate'])->name('admin.profile.update');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/logout', function () {
        return redirect()->route('admin.logout');
    });
});

Route::get('/run-migrations', function () {
    // Optional: Add a basic security key check
    if (request('key') !== 'SecretKey123') {
        abort(403, 'Unauthorized');
    }

    Artisan::call('migrate', [
        '--force' => true
    ]);

    return 'Migrations ran successfully.';
});


Route::get('/session-test', function () {
    session(['key' => 'value']);
    return session('key', 'nothing');
});

