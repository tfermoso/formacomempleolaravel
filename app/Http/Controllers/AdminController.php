<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Candidato;
use App\Models\Oferta;

class AdminController extends Controller
{
    public function dashboard()
    {
        $empresasCount = Empresa::count();
        $candidatosCount = Candidato::count();
        $ofertasCount = Oferta::count();

        $ultimasEmpresas = Empresa::latest()->take(3)->get();
        $ultimosCandidatos = Candidato::latest()->take(3)->get();

        // Importante: conCount para número de candidatos por oferta
        // Si tu relación NO se llama "candidatos", cambia ->withCount('candidatos')
        $ultimasOfertas = Oferta::latest()
            ->withCount('candidatos')
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'empresasCount',
            'candidatosCount',
            'ofertasCount',
            'ultimasEmpresas',
            'ultimosCandidatos',
            'ultimasOfertas'
        ));
    }
}
