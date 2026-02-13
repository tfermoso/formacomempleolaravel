<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Oferta;
use App\Models\Empresa;
use App\Models\Sector;
use App\Models\Modalidad;
use App\Models\Puesto;
use Illuminate\Http\Request;

class OfertaController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $estado = $request->query('estado');
        $empresaId = $request->query('empresa_id');

        $ofertas = Oferta::query()
            ->with(['empresa', 'sector', 'modalidad', 'puesto'])
            ->withCount('candidatos')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('titulo', 'like', "%{$q}%")
                        ->orWhere('ubicacion', 'like', "%{$q}%");
                });
            })
            ->when($estado, fn($query) => $query->where('estado', $estado))
            ->when($empresaId, fn($query) => $query->where('idempresa', $empresaId))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $empresas = Empresa::orderBy('nombre')->get(['id', 'nombre']);

        return view('admin.ofertas.index', compact('ofertas', 'q', 'estado', 'empresaId', 'empresas'));
    }

    public function create()
    {
        $empresas = Empresa::orderBy('nombre')->get();
        $sectores = Sector::orderBy('nombre')->get();
        $modalidades = Modalidad::orderBy('nombre')->get();
        $puestos = Puesto::orderBy('nombre')->get();

        return view('admin.ofertas.create', compact('empresas', 'sectores', 'modalidades', 'puestos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idempresa' => ['required', 'exists:empresas,id'],
            'idsector' => ['required', 'exists:sectores,id'],
            'idmodalidad' => ['required', 'exists:modalidad,id'], // tu tabla se llama modalidad
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

        // regla extra: salario_max >= salario_min
        if (!is_null($validated['salario_min'] ?? null) && !is_null($validated['salario_max'] ?? null)) {
            if ((float) $validated['salario_max'] < (float) $validated['salario_min']) {
                return back()
                    ->withErrors(['salario_max' => 'El salario máximo no puede ser menor que el salario mínimo.'])
                    ->withInput();
            }
        }

        $oferta = Oferta::create($validated);

        return redirect()
            ->route('admin.ofertas.show', $oferta)
            ->with('success', 'Oferta creada correctamente.');
    }

    public function show(Oferta $oferta)
    {
        // Candidatos inscritos + pivot (estado, fecha_inscripcion, comentarios...)
        $oferta->load(['empresa', 'sector', 'modalidad', 'puesto']);
        $candidatos = $oferta->candidatos()
            ->with('user')
            ->withPivot(['estado', 'fecha_inscripcion', 'comentarios'])
            ->orderByPivot('fecha_inscripcion', 'desc')
            ->get();

        $oferta->loadCount('candidatos');

        return view('admin.ofertas.show', compact('oferta', 'candidatos'));
    }

    public function edit(Oferta $oferta)
    {
        $empresas = Empresa::orderBy('nombre')->get();
        $sectores = Sector::orderBy('nombre')->get();
        $modalidades = Modalidad::orderBy('nombre')->get();
        $puestos = Puesto::orderBy('nombre')->get();

        return view('admin.ofertas.edit', compact('oferta', 'empresas', 'sectores', 'modalidades', 'puestos'));
    }

    public function update(Request $request, Oferta $oferta)
    {
        $validated = $request->validate([
            'idempresa' => ['required', 'exists:empresas,id'],
            'idsector' => ['required', 'exists:sectores,id'],
            'idmodalidad' => ['required', 'exists:modalidad,id'],
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

        if (!is_null($validated['salario_min'] ?? null) && !is_null($validated['salario_max'] ?? null)) {
            if ((float) $validated['salario_max'] < (float) $validated['salario_min']) {
                return back()
                    ->withErrors(['salario_max' => 'El salario máximo no puede ser menor que el salario mínimo.'])
                    ->withInput();
            }
        }

        $oferta->update($validated);

        return redirect()
            ->route('admin.ofertas.show', $oferta)
            ->with('success', 'Oferta actualizada correctamente.');
    }

    public function destroy(Oferta $oferta)
    {
        $oferta->delete();

        return redirect()
            ->route('admin.ofertas.index')
            ->with('success', 'Oferta eliminada correctamente.');
    }

    // PATCH /admin/ofertas/{oferta}/estado
    public function cambiarEstado(Request $request, Oferta $oferta)
    {
        $data = $request->validate([
            'estado' => ['required', 'in:borrador,publicada,pausada,cerrada,vencida'],
        ]);

        $oferta->update(['estado' => $data['estado']]);

        return back()->with('success', 'Estado actualizado.');
    }
}
