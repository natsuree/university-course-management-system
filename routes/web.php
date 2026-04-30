<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
Route::post('/enrollments/store', [EnrollmentController::class, 'store'])->name('enrollments.store');

Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
Route::post('/schedules/store', [ScheduleController::class, 'store'])->name('schedules.store');

Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
Route::post('/grades/store', [GradeController::class, 'store'])->name('grades.store');

Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::post('/payments/process', [PaymentController::class, 'processPayment'])->name('payments.process');