<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('user.events');
        }
        )->name('dashboard');

        // User Routes
        Route::get('events', [\App\Http\Controllers\User\HomeController::class , 'index'])->name('user.events');

        // Admin Routes
        Route::middleware(\App\Http\Middleware\IsAdmin::class)->prefix('admin')->name('admin.')->group(function () {
            Route::get('dashboard', [\App\Http\Controllers\Admin\EventController::class , 'dashboard'])->name('dashboard');
            Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
        }
        );
    });

require __DIR__ . '/settings.php';
