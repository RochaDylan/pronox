<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'verified', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/games', function () {
        return Inertia::render('Admin/Games');
    })->name('games');

    Route::get('/groups', function () {
        return Inertia::render('Admin/Groups');
    })->name('groups');

    Route::get('/users', function () {
        return Inertia::render('Admin/Users');
    })->name('users');

});