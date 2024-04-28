<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CheckoutController as AdminCheckoutController;

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

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


//Socialite Routes
Route::get('sign-in-google', [UserController::class, 'google'])->name('user.login.google');
Route::get('auth/google/callback', [UserController::class, 'handleProviderCallback'])
    ->name('user.google.callback');

Route::middleware(['auth'])->group(function () {
    // Checkout Routes
    Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success')
        ->middleware('ensureUserRole:user');
    Route::get('checkout/{camp:slug}', [CheckoutController::class, 'create'])->name('checkout.create')
        ->middleware('ensureUserRole:user');;
    Route::post('checkout/{camp}', [CheckoutController::class, 'store'])->name('checkout.store')
        ->middleware('ensureUserRole:user');;

    // Dashboard
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    //User Dashboard
    Route::prefix('user/dashboard')->namespace('User')->name('user.')
        ->middleware('ensureUserRole:user')->group(function () {
            Route::get('/', [UserDashboardController::class, 'index'])->name('dashboard');
        });

    // Admin Dashboard
    Route::prefix('admin/dashboard')->namespace('Admin')->name('admin.')
        ->middleware('ensureUserRole:admin')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

            // Admin Checkout
            Route::post('checkout/{checkout}', [AdminCheckoutController::class, 'update'])->name('checkout.update');
        });
});
