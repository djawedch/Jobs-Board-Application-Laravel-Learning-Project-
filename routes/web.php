<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{JobController, SessionController, RegisteredUserController, SearchController, TagController};

Route::get('/', [JobController::class, 'index'])->name('jobs.index');

Route::middleware('auth')->group(function () {
    Route::prefix('jobs')->controller(JobController::class)->group(function () {
        Route::get('/create', 'create')->name('jobs.create');
        Route::post('/', 'store')->name('jobs.store');
        Route::get('/{job}/edit', 'edit')->name('jobs.edit');
        Route::patch('/{job}', 'update')->name('jobs.update');
        Route::get('/{job}', 'show')->name('jobs.show');
        Route::delete('/{job}', 'destroy')->name('jobs.destroy');
    });

    Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::controller(RegisteredUserController::class)->group(function () {
        Route::get('/register', 'create')->name('register');
        Route::post('/register', 'store')->name('register.store');
    });

    Route::controller(SessionController::class)->group(function () {
        Route::get('/login', 'create')->name('login');
        Route::post('/login', 'store')->name('login.store');
    });
});

Route::get('/search', SearchController::class)->name('search');
Route::get('/tags/{tag:name}', TagController::class)->name('tags.show');