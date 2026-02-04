<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{JobController, SessionController, RegisteredUserController, SearchController, TagController};

Route::get('/', [JobController::class, 'index'])->name('jobs.index');

Route::middleware('auth')->group(function () 
{
    Route::prefix('jobs')->controller(JobController::class)->group(function () {
        Route::get('/create', 'create')->name('jobs.create');
        Route::post('/', 'store')->name('jobs.store');
    });

    Route::controller(SessionController::class)->group(function () {
        Route::delete('/logout', 'destroy')->name('logout');
    });
});

Route::middleware('guest')->group(function () 
{
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
