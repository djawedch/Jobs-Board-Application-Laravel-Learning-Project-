<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{JobController, LoginController, RegisterController, SearchController};

Route::get('/search', SearchController::class)->name('search');

Route::middleware('guest')->group(function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'create')->name('register');
        Route::post('/register', 'store')->name('register.store');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'create')->name('login');
        Route::post('/login', 'store')->name('login.store');
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('jobs')->controller(JobController::class)->group(function () {
        Route::get('/create', 'create')->name('jobs.create');
        Route::post('/', 'store')->name('jobs.store');
        Route::get('/{job}/edit', 'edit')->name('jobs.edit');
        Route::patch('/{job}', 'update')->name('jobs.update');
        Route::delete('/{job}', 'destroy')->name('jobs.destroy');
    });

    Route::delete('/logout', [LoginController::class, 'destroy'])->name('logout');
});

Route::controller(JobController::class)->group(function () {
    Route::get('/', 'index')->name('jobs.index');
    Route::get('/jobs/{job}', 'show')->name('jobs.show');
});