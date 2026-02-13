<?php

use App\Http\Controllers\OfertaCandidatoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\Admin\EmpresaController as AdminEmpresaController;
use App\Http\Controllers\Admin\CandidatoController as AdminCandidatoController;
use App\Http\Controllers\Admin\OfertaController as AdminOfertaController;
use App\Models\Oferta;

Route::get('/', function () {
    // Si quieres mostrar ofertas recientes en la home, puedes cargar aquí las últimas ofertas activas
     $ultimasOfertas = Oferta::where('estado', 'publicada')->latest()->take(5)->get();
     return view('welcome', compact('ultimasOfertas'));
    
})->name('welcome');

Route::get('/empresa/register', function () {
    $role = 'empresa';
    return view('auth.register', compact('role'));
})->name('empresa.register');

Route::get('/candidato/register', function () {
    $role = 'candidato';
    return view('auth.register', compact('role'));
})->name('candidato.register');

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


    Route::middleware('role:admin')
            ->prefix('admin')
            ->name('admin.')
            ->group(function () {
                Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

                Route::resource('empresas', AdminEmpresaController::class);
                Route::resource('candidatos', AdminCandidatoController::class);
                Route::resource('ofertas', AdminOfertaController::class);

                // Acción rápida: cambiar estado oferta (opcional)
                Route::patch('ofertas/{oferta}/estado', [AdminOfertaController::class, 'cambiarEstado'])
                    ->name('ofertas.estado');
            });


    Route::middleware('role:empresa')->group(function () {
        Route::get('/empresa', [EmpresaController::class, 'dashboard'])->name('empresa.dashboard');
        Route::get('/empresa/crear-empresa', [EmpresaController::class, 'crearEmpresa'])->name('empresa.crear-empresa');
        Route::post('/empresa/crear-empresa', [EmpresaController::class, 'store'])->name('empresa.store');
        Route::get('/empresa/editar', [EmpresaController::class, 'edit'])->name('empresa.edit');
        Route::put('/empresa', [EmpresaController::class, 'update'])->name('empresa.update');
        Route::get('/empresa/crear-oferta', [EmpresaController::class, 'crearOferta'])->name('empresa.crear-oferta');
        Route::post('/empresa/crear-oferta', [EmpresaController::class, 'storeOferta'])->name('empresa.storeOferta');
        Route::get('/empresa/ofertas/ver/{oferta}', [EmpresaController::class, 'show'])->name('empresa.ofertas.show');
        Route::get('/empresa/ofertas/editar/{oferta}', [EmpresaController::class, 'editOferta'])->name('empresa.editOferta');
        Route::put('/empresa/ofertas/{id}', [EmpresaController::class, 'updateOferta'])
            ->name('empresa.updateOferta');
        Route::get('/empresa/candidatos/{candidato}/cv', [OfertaCandidatoController::class, 'downloadCv'])
            ->name('empresa.candidatos.cv.download');

        // Descargar ZIP con todos los CV de una oferta
        Route::get('/empresa/ofertas/{oferta}/cvs.zip', [OfertaCandidatoController::class, 'downloadAllCvsZip'])
            ->name('empresa.ofertas.cvs.zip');

        Route::middleware(['auth', 'role:empresa'])
            ->prefix('empresa')
            ->group(function () {
                Route::post('/candidatos/{candidato}/estado', [OfertaCandidatoController::class, 'updateEstado'])
                    ->name('empresa.candidatos.estado');
            });

    });
    Route::middleware('role:candidato')->group(function () {
        Route::get('/candidato', [CandidatoController::class, 'dashboard'])->name('candidato.dashboard');

        Route::get('/candidato/crear', [CandidatoController::class, 'create'])->name('candidato.create');
        Route::post('/candidato', [CandidatoController::class, 'store'])->name('candidato.store');

        Route::get('/candidato/editar', [CandidatoController::class, 'edit'])->name('candidato.edit');
        Route::put('/candidato', [CandidatoController::class, 'update'])->name('candidato.update');

        // ofertas / inscripciones
        Route::get('/ofertas', [CandidatoController::class, 'ofertas'])->name('candidato.ofertas');
        Route::post('/ofertas/{oferta}/inscribirse', [CandidatoController::class, 'inscribirse'])->name('candidato.ofertas.inscribirse');
        Route::get('/ofertas/{oferta}/ver', [CandidatoController::class, 'show'])->name('candidato.ofertas.show');
        Route::get('/mis-candidaturas', [CandidatoController::class, 'misCandidaturas'])->name('candidato.candidaturas');
        Route::delete('/ofertas/{oferta}/retirar', [CandidatoController::class, 'retirar'])->name('candidato.ofertas.retirar'); // opcional


    });


});
