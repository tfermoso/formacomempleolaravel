<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $empresas = Empresa::query()
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('nombre', 'like', "%{$q}%")
                        ->orWhere('cif', 'like', "%{$q}%")
                        ->orWhere('email_contacto', 'like', "%{$q}%")
                        ->orWhere('ciudad', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.empresas.index', compact('empresas', 'q'));
    }

    public function create()
    {
        $sectores = Sector::orderBy('nombre')->get();
        return view('admin.empresas.create', compact('sectores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cif' => ['required', 'string', 'max:20', 'unique:empresas,cif'],
            'nombre' => ['required', 'string', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'web' => ['nullable', 'url', 'max:255'],
            'persona_contacto' => ['nullable', 'string', 'max:255'],
            'email_contacto' => ['nullable', 'email', 'max:255'],
            'direccion' => ['nullable', 'string', 'max:255'],
            'cp' => ['nullable', 'string', 'max:10'],
            'ciudad' => ['nullable', 'string', 'max:100'],
            'provincia' => ['nullable', 'string', 'max:100'],

            'sectores' => ['nullable', 'array'],
            'sectores.*' => ['integer', 'exists:sectores,id'],

            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $empresa = DB::transaction(function () use ($request, $validated) {
            $logoPath = null;

            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('empresas/logos', 'public');
            }

            $empresa = Empresa::create([
                'cif' => $validated['cif'],
                'nombre' => $validated['nombre'],
                'telefono' => $validated['telefono'] ?? null,
                'web' => $validated['web'] ?? null,
                'persona_contacto' => $validated['persona_contacto'] ?? null,
                'email_contacto' => $validated['email_contacto'] ?? null,
                'direccion' => $validated['direccion'] ?? null,
                'cp' => $validated['cp'] ?? null,
                'ciudad' => $validated['ciudad'] ?? null,
                'provincia' => $validated['provincia'] ?? null,
                'logo' => $logoPath,
            ]);

            $empresa->sectores()->sync($validated['sectores'] ?? []);

            return $empresa;
        });

        return redirect()
            ->route('admin.empresas.show', $empresa)
            ->with('success', 'Empresa creada correctamente.');
    }

    public function show(Empresa $empresa)
    {
        $empresa->load('sectores');
        return view('admin.empresas.show', compact('empresa'));
    }

    public function edit(Empresa $empresa)
    {
        $sectores = Sector::orderBy('nombre')->get();
        $empresa->load('sectores');

        // ids seleccionados para checkboxes
        $selectedSectores = $empresa->sectores->pluck('id')->all();

        return view('admin.empresas.edit', compact('empresa', 'sectores', 'selectedSectores'));
    }

    public function update(Request $request, Empresa $empresa)
    {
        $validated = $request->validate([
            'cif' => ['required', 'string', 'max:20', 'unique:empresas,cif,' . $empresa->id],
            'nombre' => ['required', 'string', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'web' => ['nullable', 'url', 'max:255'],
            'persona_contacto' => ['nullable', 'string', 'max:255'],
            'email_contacto' => ['nullable', 'email', 'max:255'],
            'direccion' => ['nullable', 'string', 'max:255'],
            'cp' => ['nullable', 'string', 'max:10'],
            'ciudad' => ['nullable', 'string', 'max:100'],
            'provincia' => ['nullable', 'string', 'max:100'],

            'sectores' => ['nullable', 'array'],
            'sectores.*' => ['integer', 'exists:sectores,id'],

            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_logo' => ['nullable', 'boolean'],
        ]);

        DB::transaction(function () use ($request, $validated, $empresa) {

            // eliminar logo si se marca
            if (!empty($validated['remove_logo']) && $empresa->logo) {
                Storage::disk('public')->delete($empresa->logo);
                $empresa->logo = null;
            }

            // si suben nuevo logo, reemplaza (borra anterior)
            if ($request->hasFile('logo')) {
                if ($empresa->logo) {
                    Storage::disk('public')->delete($empresa->logo);
                }
                $empresa->logo = $request->file('logo')->store('empresas/logos', 'public');
            }

            $empresa->fill([
                'cif' => $validated['cif'],
                'nombre' => $validated['nombre'],
                'telefono' => $validated['telefono'] ?? null,
                'web' => $validated['web'] ?? null,
                'persona_contacto' => $validated['persona_contacto'] ?? null,
                'email_contacto' => $validated['email_contacto'] ?? null,
                'direccion' => $validated['direccion'] ?? null,
                'cp' => $validated['cp'] ?? null,
                'ciudad' => $validated['ciudad'] ?? null,
                'provincia' => $validated['provincia'] ?? null,
            ])->save();

            $empresa->sectores()->sync($validated['sectores'] ?? []);
        });

        return redirect()
            ->route('admin.empresas.show', $empresa)
            ->with('success', 'Empresa actualizada correctamente.');
    }

    public function destroy(Empresa $empresa)
    {
        // borrar logo físico (opcional)
        if ($empresa->logo) {
            Storage::disk('public')->delete($empresa->logo);
        }

        $empresa->delete();

        return redirect()
            ->route('admin.empresas.index')
            ->with('success', 'Empresa eliminada correctamente.');
    }
}
