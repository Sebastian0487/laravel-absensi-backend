<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DashboardController;

// Route default ke halaman login
Route::get('/', function () {
    return view('pages.auth.auth-login');
});

// Route dengan middleware auth
Route::middleware(['auth'])->group(function () {
    // Route Home (Redirect ke Dashboard)
    Route::get('home', function () {
        return redirect()->route('dashboard');
    })->name('home');

    // Route Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Custom untuk Download PDF
    Route::get('/attendances/download-pdf/{filter}', [AttendanceController::class, 'downloadFilteredPdf'])->name('attendances.download-filtered-pdf');
    Route::get('/users/{user_id}/download-pdf', [AttendanceController::class, 'downloadUserPdf'])->name('users.download-user-pdf');
    Route::get('/attendances/{user_id}/download-pdf', [AttendanceController::class, 'downloadUserPdf'])->name('attendances.download-user-pdf');

    // Resource Routes
    Route::resource('users', UserController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('permissions', PermissionController::class);
});
