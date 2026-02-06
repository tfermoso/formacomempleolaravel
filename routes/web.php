<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', fn () => view('admin.dashboard'))->name('admin.dashboard');
    });

    Route::middleware('role:empresa')->group(function () {
        Route::get('/empresa', fn () => view('empresa.dashboard'))->name('empresa.dashboard');
    });

    Route::middleware('role:candidato')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');    });
});
