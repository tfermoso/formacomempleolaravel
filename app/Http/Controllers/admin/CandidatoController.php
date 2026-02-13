<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CandidatoController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $candidatos = Candidato::query()
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('nombre', 'like', "%{$q}%")
                        ->orWhere('apellidos', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('dni', 'like', "%{$q}%")
                        ->orWhere('telefono', 'like', "%{$q}%")
                        ->orWhere('ciudad', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.candidatos.index', compact('candidatos', 'q'));
    }

    public function create()
    {
        return view('admin.candidatos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dni' => ['nullable', 'string', 'max:20', 'unique:candidatos,dni'],
            'nombre' => ['required', 'string', 'max:100'],
            'apellidos' => ['required', 'string', 'max:150'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:150', 'unique:candidatos,email'],

            'linkedin' => ['nullable', 'string', 'max:255'],
            'web' => ['nullable', 'url', 'max:255'],

            'direccion' => ['nullable', 'string', 'max:200'],
            'cp' => ['nullable', 'string', 'max:10'],
            'ciudad' => ['nullable', 'string', 'max:100'],
            'provincia' => ['nullable', 'string', 'max:100'],
            'fecha_nacimiento' => ['nullable', 'date'],

            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:4096'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $candidato = DB::transaction(function () use ($request, $validated) {
            $cvPath = null;
            if ($request->hasFile('cv')) {
                $cvPath = $request->file('cv')->store('candidatos/cv', 'public');
            }

            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('candidatos/fotos', 'public');
            }

            return Candidato::create([
                // OJO: no asignamos user_id aquí (admin crea candidato “libre”)
                'dni' => $validated['dni'] ?? null,
                'nombre' => $validated['nombre'],
                'apellidos' => $validated['apellidos'],
                'telefono' => $validated['telefono'] ?? null,
                'email' => $validated['email'] ?? null,

                'linkedin' => $validated['linkedin'] ?? null,
                'web' => $validated['web'] ?? null,

                'cv' => $cvPath,
                'foto' => $fotoPath,

                'direccion' => $validated['direccion'] ?? null,
                'cp' => $validated['cp'] ?? null,
                'ciudad' => $validated['ciudad'] ?? null,
                'provincia' => $validated['provincia'] ?? null,
                'fecha_nacimiento' => $validated['fecha_nacimiento'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.candidatos.show', $candidato)
            ->with('success', 'Candidato creado correctamente.');
    }

    public function show(Candidato $candidato)
    {
        return view('admin.candidatos.show', compact('candidato'));
    }

    public function edit(Candidato $candidato)
    {
        return view('admin.candidatos.edit', compact('candidato'));
    }

    public function update(Request $request, Candidato $candidato)
    {
        $validated = $request->validate([
            'dni' => ['nullable', 'string', 'max:20', Rule::unique('candidatos', 'dni')->ignore($candidato->id)],
            'nombre' => ['required', 'string', 'max:100'],
            'apellidos' => ['required', 'string', 'max:150'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:150', Rule::unique('candidatos', 'email')->ignore($candidato->id)],

            'linkedin' => ['nullable', 'string', 'max:255'],
            'web' => ['nullable', 'url', 'max:255'],

            'direccion' => ['nullable', 'string', 'max:200'],
            'cp' => ['nullable', 'string', 'max:10'],
            'ciudad' => ['nullable', 'string', 'max:100'],
            'provincia' => ['nullable', 'string', 'max:100'],
            'fecha_nacimiento' => ['nullable', 'date'],

            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:4096'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'remove_cv' => ['nullable', 'boolean'],
            'remove_foto' => ['nullable', 'boolean'],
        ]);

        DB::transaction(function () use ($request, $candidato, $validated) {

            // borrar CV
            if (!empty($validated['remove_cv']) && $candidato->cv) {
                Storage::disk('public')->delete($candidato->cv);
                $candidato->cv = null;
            }

            // borrar Foto
            if (!empty($validated['remove_foto']) && $candidato->foto) {
                Storage::disk('public')->delete($candidato->foto);
                $candidato->foto = null;
            }

            // reemplazo CV
            if ($request->hasFile('cv')) {
                if ($candidato->cv) Storage::disk('public')->delete($candidato->cv);
                $candidato->cv = $request->file('cv')->store('candidatos/cv', 'public');
            }

            // reemplazo foto
            if ($request->hasFile('foto')) {
                if ($candidato->foto) Storage::disk('public')->delete($candidato->foto);
                $candidato->foto = $request->file('foto')->store('candidatos/fotos', 'public');
            }

            $candidato->fill([
                'dni' => $validated['dni'] ?? null,
                'nombre' => $validated['nombre'],
                'apellidos' => $validated['apellidos'],
                'telefono' => $validated['telefono'] ?? null,
                'email' => $validated['email'] ?? null,

                'linkedin' => $validated['linkedin'] ?? null,
                'web' => $validated['web'] ?? null,

                'direccion' => $validated['direccion'] ?? null,
                'cp' => $validated['cp'] ?? null,
                'ciudad' => $validated['ciudad'] ?? null,
                'provincia' => $validated['provincia'] ?? null,
                'fecha_nacimiento' => $validated['fecha_nacimiento'] ?? null,
            ])->save();
        });

        return redirect()
            ->route('admin.candidatos.show', $candidato)
            ->with('success', 'Candidato actualizado correctamente.');
    }

    public function destroy(Candidato $candidato)
    {
        if ($candidato->cv) Storage::disk('public')->delete($candidato->cv);
        if ($candidato->foto) Storage::disk('public')->delete($candidato->foto);

        $candidato->delete();

        return redirect()
            ->route('admin.candidatos.index')
            ->with('success', 'Candidato eliminado correctamente.');
    }
}
