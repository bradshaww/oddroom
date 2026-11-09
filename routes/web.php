<?php

use App\Http\Controllers\AdminSlotController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\AdminStudioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MyBookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\BookingController;
Route::get('/', function () {
    return view('home');
});

Route::get('/studios', [StudioController::class, 'index']);
Route::get('/studios/{studio_id}', [StudioController::class, 'show']);
Route::get('/booking', [BookingController::class, 'create']);

Route::post('/booking', [BookingController::class, 'store'])
    ->middleware('auth');

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);


Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
    ->name('password.email');

Route::get('/reset-password/{token}', [
    PasswordResetController::class,
    'showResetForm'
])->name('password.reset');

Route::post('/reset-password', [
    PasswordResetController::class,
    'resetPassword'
])->name('password.update');

Route::get('/payment/{booking_id}', [PaymentController::class, 'create'])
    ->middleware('auth');

Route::post('/payment/{booking_id}', [PaymentController::class, 'store'])
    ->middleware('auth');

Route::get('/my-bookings', [MyBookingController::class, 'index'])
    ->middleware('auth');

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware(['auth', 'admin']);

    
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/studios', [AdminStudioController::class, 'index']);
        Route::get('/studios/create', [AdminStudioController::class, 'create']);
        Route::post('/studios', [AdminStudioController::class, 'store']);
        Route::get('/studios/{studio_id}/slots', [
    AdminSlotController::class,
    'index'
]);

Route::post('/studios/{studio_id}/slots', [
    AdminSlotController::class,
    'store'
]);

Route::put('/studios/{studio_id}/slots/{slot_id}', [
    AdminSlotController::class,
    'update'
]);

Route::delete('/studios/{studio_id}/slots/{slot_id}', [
    AdminSlotController::class,
    'destroy'
]);
        Route::get('/studios/{studio_id}/edit', [AdminStudioController::class, 'edit']);
        Route::put('/studios/{studio_id}', [AdminStudioController::class, 'update']);
        Route::delete('/studios/{studio_id}', [AdminStudioController::class, 'destroy']);
        Route::get('/users', [AdminUserController::class, 'index']);
        Route::delete('/users/{user_id}', [AdminUserController::class, 'destroy']);

 Route::get('/payments', [AdminPaymentController::class, 'index']);

Route::post('/payments/{payment_id}/approve', [
    AdminPaymentController::class,
    'approve'
]);

Route::post('/payments/{payment_id}/reject', [
    AdminPaymentController::class,
    'reject'
]);
    });

    