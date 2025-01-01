<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChangePasswordController;

Route::get('/', function () {
    return view('auth.login');
})->middleware(['logger', 'add-csp-headers']);

Route::middleware(['web', 'logger', 'add-csp-headers'])->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});
Route::get('logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->middleware(['logger']);

Route::group(['middleware' => ['web', 'auth', 'logger', 'add-csp-headers']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('change/password', [ChangePasswordController::class, 'create'])->name('change.password.create');
    Route::post('change/password', [ChangePasswordController::class, 'store'])->name('change.password.store');

    // Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    // Route::get('notifications/{url}', [NotificationController::class, 'show'])->name('notifications.show');
});
