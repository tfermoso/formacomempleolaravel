<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        $user = auth()->user();
        $role = is_object($user->role) ? $user->role->value : $user->role;

        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'empresa' => redirect()->route('empresa.dashboard'),
            'candidato' => redirect()->route('candidato.dashboard'),
            default => abort(403),
        };
    })->name('dashboard');


    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', fn() => view('admin.dashboard'))->name('admin.dashboard');
    });

    Route::middleware('role:empresa')->group(function () {
        Route::get('/empresa', fn() => view('empresa.dashboard'))->name('empresa.dashboard');
    });
      Route::middleware('role:candidato')->group(function () {
        Route::get('/candidato', fn() => view('candidato.dashboard'))->name('candidato.dashboard');
    });

  
});
