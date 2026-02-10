<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Sector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class EmpresaController extends Controller
{
    public function dashboard()
    {
        //Si el usuario no tiene una empresa asociada, redirigir a la vista de crear empresa
        if (!auth()->user()->empresa) {
            return redirect()->route('empresa.crear-empresa');
        }

        return view('empresa.dashboard');
    }

    public function crearEmpresa()
    {
        $sectores = Sector::all();  
        return view('empresa.crear-empresa', compact('sectores'));
    }

    public function crearOferta()
    {
        return view('empresa.crear-oferta');
    }


public function store(Request $request)
{
    $validated = $request->validate([
        'cif'             => ['required','string','max:20','unique:empresas,cif'],
        'nombre'          => ['required','string','max:255'],
        'telefono'        => ['nullable','string','max:30'],
        'web'             => ['nullable','url','max:255'],
        'persona_contacto'=> ['nullable','string','max:255'],
        'email_contacto'  => ['nullable','email','max:255'],
        'direccion'       => ['nullable','string','max:255'],
        'cp'              => ['nullable','string','max:10'],
        'ciudad'          => ['nullable','string','max:100'],
        'provincia'       => ['nullable','string','max:100'],

        // checkbox
        'sectores'        => ['nullable','array'],
        'sectores.*'      => ['integer','exists:sectores,id'],

        // logo
        'logo'            => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
    ]);

    DB::transaction(function () use ($request, $validated) {

        // 1) Subir logo (si viene)
        $logoPath = null;
        if ($request->hasFile('logo')) {
            // storage/app/public/empresas/logos/...
            $logoPath = $request->file('logo')->store('empresas/logos', 'public');
        }

        // 2) Crear empresa
        $empresa = Empresa::create([
            'cif'              => $validated['cif'],
            'nombre'           => $validated['nombre'],
            'telefono'         => $validated['telefono'] ?? null,
            'web'              => $validated['web'] ?? null,
            'persona_contacto' => $validated['persona_contacto'] ?? null,
            'email_contacto'   => $validated['email_contacto'] ?? null,
            'direccion'        => $validated['direccion'] ?? null,
            'cp'               => $validated['cp'] ?? null,
            'ciudad'           => $validated['ciudad'] ?? null,
            'provincia'        => $validated['provincia'] ?? null,
            'logo'             => $logoPath, // guarda el path relativo (public disk)
        ]);

        // 3) Asociar sectores (many-to-many)
        $empresa->sectores()->sync($validated['sectores'] ?? []);
        // 4) Asociar empresa al usuario autenticado
        $user = auth()->user();
        $user->empresa_id = $empresa->id;
        $user->save();
    });

    return redirect()
        ->route('empresa.dashboard')
        ->with('success', 'Empresa creada exitosamente.');
}
  
}
