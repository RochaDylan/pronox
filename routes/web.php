<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return auth()->user()->isAdmin() ? redirect()->route('admin.dashboard') : redirect()->route('user.dashboard');})->name('dashboard');
});

require __DIR__.'/admin.php';
require __DIR__.'/user.php';
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
