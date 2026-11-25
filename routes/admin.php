<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GameController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'verified', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/games', [GameController::class, 'index'])->name('games');
    Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');
    Route::patch('/games/{game}/score', [GameController::class, 'updateScore'])->name('games.score');

    Route::get('/groups', function () {
        return Inertia::render('Admin/Groups');
    })->name('groups');

    Route::get('/users', function () {
        return Inertia::render('Admin/Users');
    })->name('users');


});