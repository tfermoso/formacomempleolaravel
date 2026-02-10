<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Sector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Puesto;
use App\Models\Modalidad;
use App\Models\Oferta;



class EmpresaController extends Controller
{
    public function dashboard()
    {
        //Si el usuario no tiene una empresa asociada, redirigir a la vista de crear empresa
        if (!auth()->user()->empresa) {
            return redirect()->route('empresa.crear-empresa');
        }
        //Recuperar las ofertas publicadas en activo y el número de candidatos que han aplicado a cada oferta
        $ofertas = auth()->user()->empresa->ofertas()
            ->whereIn('estado', ['publicada', 'pausada'])
            ->get();
        return view('empresa.dashboard', compact('ofertas'));
    }

    public function crearEmpresa()
    {
        $sectores = Sector::all();
        return view('empresa.crear-empresa', compact('sectores'));
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

            // checkbox
            'sectores' => ['nullable', 'array'],
            'sectores.*' => ['integer', 'exists:sectores,id'],

            // logo
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
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
                'logo' => $logoPath, // guarda el path relativo (public disk)
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


    public function edit()
    {
        $empresa = auth()->user()->empresa;

        if (!$empresa) {
            return redirect()->route('empresa.crear-empresa');
        }

        $sectores = Sector::all();

        return view('empresa.edit-empresa', compact('empresa', 'sectores'));
    }

    public function update(Request $request)
    {
        $empresa = auth()->user()->empresa;

        if (!$empresa) {
            return redirect()->route('empresa.crear-empresa');
        }

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
        ]);

        DB::transaction(function () use ($request, $empresa, $validated) {

            // Logo nuevo: borrar el anterior y guardar el nuevo
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

            // sectores
            $empresa->sectores()->sync($validated['sectores'] ?? []);
        });

        return redirect()
            ->route('empresa.dashboard')
            ->with('success', 'Empresa actualizada correctamente.');
    }

    //Crear oferta, editar oferta, eliminar oferta, etc... (CRUD completo de ofertas)
    public function eliminarOferta($id)
    {
        // Lógica para eliminar una oferta
    }


    public function crearOferta()
    {
        $empresa = auth()->user()->empresa;

        if (!$empresa) {
            return redirect()->route('empresa.crear-empresa')
                ->with('error', 'Antes debes completar los datos de tu empresa.');
        }

        $sectores = Sector::orderBy('nombre')->get();
        $modalidades = Modalidad::orderBy('nombre')->get();
        $puestos = Puesto::orderBy('nombre')->get();

        return view('empresa.crear-oferta', compact('sectores', 'modalidades', 'puestos'));
    }

    public function storeOferta(Request $request)
    {
        $empresa = auth()->user()->empresa;

        if (!$empresa) {
            return redirect()->route('empresa.crear-empresa')
                ->with('error', 'Antes debes completar los datos de tu empresa.');
        }

        $validated = $request->validate([
            'idsector' => ['required', 'exists:sectores,id'],
            'idmodalidad' => ['required', 'exists:modalidad,id'], // tu FK apunta a "modalidad"
            'idpuesto' => ['required', 'exists:puestos,id'],

            'titulo' => ['required', 'string', 'max:200'],
            'descripcion' => ['required', 'string'],
            'requisitos' => ['nullable', 'string'],
            'funciones' => ['nullable', 'string'],

            'salario_min' => ['nullable', 'numeric', 'min:0'],
            'salario_max' => ['nullable', 'numeric', 'min:0'],

            'tipo_contrato' => ['nullable', 'string', 'max:100'],
            'jornada' => ['nullable', 'string', 'max:100'],
            'ubicacion' => ['nullable', 'string', 'max:150'],

            'fecha_publicacion' => ['nullable', 'date'],
            'publicar_hasta' => ['nullable', 'date', 'after_or_equal:fecha_publicacion'],
            'fecha_incorporacion' => ['nullable', 'date'],

            'estado' => ['required', 'in:borrador,publicada,pausada,cerrada,vencida'],
        ]);

        // regla extra: salario_max >= salario_min si ambos vienen
        if (!is_null($validated['salario_min'] ?? null) && !is_null($validated['salario_max'] ?? null)) {
            if ((float) $validated['salario_max'] < (float) $validated['salario_min']) {
                return back()
                    ->withErrors(['salario_max' => 'El salario máximo no puede ser menor que el salario mínimo.'])
                    ->withInput();
            }
        }

        Oferta::create([
            'idempresa' => $empresa->id,
            ...$validated,
        ]);

        return redirect()
            ->route('empresa.dashboard')
            ->with('success', 'Oferta creada exitosamente.');
    }


}
