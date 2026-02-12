<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Empresa;

class CandidatoController extends Controller
{
    // Dashboard candidato: si no tiene perfil -> crear
    public function dashboard2()
    {
        $user = auth()->user();

        if (!$user->candidato) {
            return redirect()->route('candidato.create');
        }

        // Resumen: últimas candidaturas
        $candidaturas = $user->candidato->ofertas()
            ->with(['empresa', 'puesto', 'sector', 'modalidad'])
            ->orderByPivot('fecha_inscripcion', 'desc')
            ->take(10)
            ->get();

        return view('candidato.dashboard', compact('candidaturas'));
    }


    public function dashboard()
    {
        $user = auth()->user();

        if (!$user->candidato) {
            return redirect()->route('candidato.create');
        }

        $candidato = $user->candidato;

        // Estados "abiertos" y "cerrados" en el pivot
        $estadosAbiertos = ['inscrito', 'en_revision', 'entrevista', 'finalista'];
        $estadosCerrados = ['descartado', 'contratado', 'retirado'];

        // Abiertas
        $abiertasQuery = $candidato->ofertas()
            ->with(['empresa', 'puesto', 'sector', 'modalidad'])
            ->wherePivotIn('estado', $estadosAbiertos)
            ->orderByPivot('fecha_inscripcion', 'desc');

        $abiertasCount = (clone $abiertasQuery)->count();
        $abiertasTop3 = (clone $abiertasQuery)->take(3)->get();

        // Cerradas
        $cerradasQuery = $candidato->ofertas()
            ->with(['empresa', 'puesto', 'sector', 'modalidad'])
            ->wherePivotIn('estado', $estadosCerrados)
            ->orderByPivot('fecha_inscripcion', 'desc');

        $cerradasCount = (clone $cerradasQuery)->count();
        $cerradasTop3 = (clone $cerradasQuery)->take(3)->get();

        // Ofertas publicadas (últimas 3)
        $ofertasTop3 = Oferta::query()
            ->with(['empresa', 'puesto', 'sector', 'modalidad'])
            ->where('estado', 'publicada')
            ->orderByDesc('fecha_publicacion')
            ->take(3)
            ->get();

        $ofertasPublicadasCount = Oferta::where('estado', 'publicada')->count();

        // Empresas + nº ofertas (publicadas)
        $empresasCount = Empresa::count();

        return view('candidato.dashboard', compact(
            'abiertasCount',
            'abiertasTop3',
            'cerradasCount',
            'cerradasTop3',
            'ofertasTop3',
            'ofertasPublicadasCount',
            'empresasCount'
        ));
    }


    // Form crear candidato
    public function create()
    {
        $user = auth()->user();

        if ($user->candidato) {
            return redirect()->route('candidato.dashboard');
        }

        return view('candidato.create');
    }

    // Guardar candidato asociado a user
    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->candidato) {
            return redirect()->route('candidato.dashboard');
        }

        $validated = $request->validate([
            'dni' => ['nullable', 'string', 'max:20', 'unique:candidatos,dni'],
            'nombre' => ['required', 'string', 'max:100'],
            'apellidos' => ['required', 'string', 'max:150'],
            'telefono' => ['nullable', 'string', 'max:20'],

            // email del candidato: si quieres que sea el mismo que el del user, lo rellenamos y no lo pedimos
            'email' => ['nullable', 'email', 'max:150', 'unique:candidatos,email'],

            'linkedin' => ['nullable', 'string', 'max:255'],
            'web' => ['nullable', 'url', 'max:255'],

            'direccion' => ['nullable', 'string', 'max:200'],
            'cp' => ['nullable', 'string', 'max:10'],
            'ciudad' => ['nullable', 'string', 'max:100'],
            'provincia' => ['nullable', 'string', 'max:100'],
            'fecha_nacimiento' => ['nullable', 'date'],

            // archivos opcionales
            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:4096'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // si no mandas email en el form, usamos el del user
        $email = $validated['email'] ?? $user->email;

        DB::transaction(function () use ($user, $validated, $email, $request) {

            $cvPath = null;
            if ($request->hasFile('cv')) {
                $cvPath = $request->file('cv')->store('candidatos/cv', 'public');
            }

            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('candidatos/fotos', 'public');
            }

            Candidato::create([
                'user_id' => $user->id,

                'dni' => $validated['dni'] ?? null,
                'nombre' => $validated['nombre'],
                'apellidos' => $validated['apellidos'],
                'telefono' => $validated['telefono'] ?? null,

                'email' => $email,

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

        return redirect()->route('candidato.dashboard')->with('success', 'Perfil de candidato creado.');
    }

    // Form editar candidato
    public function edit()
    {
        $candidato = auth()->user()->candidato;

        if (!$candidato) {
            return redirect()->route('candidato.create');
        }

        return view('candidato.edit', compact('candidato'));
    }

    // Actualizar candidato
    public function update(Request $request)
    {
        $user = auth()->user();
        $candidato = $user->candidato;

        if (!$candidato) {
            return redirect()->route('candidato.create');
        }

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
        ]);

        DB::transaction(function () use ($request, $candidato, $validated, $user) {

            if ($request->hasFile('cv')) {
                // si quieres borrar anterior, haz Storage::disk('public')->delete($candidato->cv);
                $candidato->cv = $request->file('cv')->store('candidatos/cv', 'public');
            }

            if ($request->hasFile('foto')) {
                $candidato->foto = $request->file('foto')->store('candidatos/fotos', 'public');
            }

            $candidato->fill([
                'dni' => $validated['dni'] ?? null,
                'nombre' => $validated['nombre'],
                'apellidos' => $validated['apellidos'],
                'telefono' => $validated['telefono'] ?? null,
                'email' => $validated['email'] ?? $user->email,
                'linkedin' => $validated['linkedin'] ?? null,
                'web' => $validated['web'] ?? null,
                'direccion' => $validated['direccion'] ?? null,
                'cp' => $validated['cp'] ?? null,
                'ciudad' => $validated['ciudad'] ?? null,
                'provincia' => $validated['provincia'] ?? null,
                'fecha_nacimiento' => $validated['fecha_nacimiento'] ?? null,
            ])->save();
        });

        return redirect()->route('candidato.dashboard')->with('success', 'Perfil actualizado.');
    }

    // Listado/búsqueda de ofertas (solo si tiene candidato)
    public function ofertas(Request $request)
    {
        $candidato = auth()->user()->candidato;

        if (!$candidato) {
            return redirect()->route('candidato.create');
        }

        $q = Oferta::query()
            ->with(['empresa', 'puesto', 'sector', 'modalidad'])
            ->where('estado', 'publicada');

        if ($request->filled('texto')) {
            $texto = $request->input('texto');
            $q->where(function ($qq) use ($texto) {
                $qq->where('titulo', 'like', "%{$texto}%")
                    ->orWhere('descripcion', 'like', "%{$texto}%")
                    ->orWhere('ubicacion', 'like', "%{$texto}%");
            });
        }

        if ($request->filled('sector_id')) {
            $q->where('idsector', $request->sector_id); // o 'sector_id' según tu BD
        }

        if ($request->filled('puesto_id')) {
            $q->where('idpuesto', $request->puesto_id); // o 'puesto_id'
        }

        if ($request->filled('modalidad_id')) {
            $q->where('idmodalidad', $request->modalidad_id); // o 'modalidad_id'
        }

        $ofertas = $q->orderByDesc('fecha_publicacion')
            ->paginate(10)
            ->withQueryString();

        // Marcamos si el candidato está inscrito en cada oferta
        $idsInscritas = $candidato->ofertas()->pluck('ofertas.id')->toArray();
        $ofertas->getCollection()->transform(function ($oferta) use ($idsInscritas) {
            $oferta->ya_inscrito = in_array($oferta->id, $idsInscritas);
            return $oferta;
        });

        return view('candidato.ofertas', compact('ofertas'));
    }


    // Inscribirse a una oferta (pivot)
    public function inscribirse(Oferta $oferta)
    {
        $candidato = auth()->user()->candidato;

        if (!$candidato) {
            return redirect()->route('candidato.create');
        }

        if ($oferta->estado !== 'publicada') {
            return back()->with('error', 'No puedes inscribirte a una oferta que no esté publicada.');
        }

        // evita duplicados
        $ya = $candidato->ofertas()->where('oferta_id', $oferta->id)->exists();
        if ($ya) {
            return back()->with('info', 'Ya estás inscrito en esta oferta.');
        }

        $candidato->ofertas()->attach($oferta->id, [
            'estado' => 'inscrito',
            'fecha_inscripcion' => now(),
            'comentarios' => null,
        ]);

        return back()->with('success', 'Inscripción realizada.');
    }

    // Ver mis candidaturas + estado (pivot)
    public function misCandidaturas(): View|RedirectResponse
    {
        $candidato = auth()->user()->candidato;

        if (!$candidato) {
            return redirect()->route('candidato.create');
        }

        $ofertas = $candidato->ofertas()
            ->with(['empresa', 'puesto', 'sector', 'modalidad'])
            ->withPivot(['estado', 'fecha_inscripcion', 'comentarios'])
            ->orderByPivot('fecha_inscripcion', 'desc')
            ->paginate(10);

        return view('candidato.candidaturas', compact('ofertas'));
    }


    // Retirar candidatura (opcional)
    public function retirar(Oferta $oferta)
    {
        $candidato = auth()->user()->candidato;

        if (!$candidato) {
            return redirect()->route('candidato.create');
        }

        $candidato->ofertas()->detach($oferta->id);

        return back()->with('success', 'Candidatura retirada.');
    }



    public function show(Oferta $oferta): View|RedirectResponse
    {
        $candidato = auth()->user()->candidato;

        if (!$candidato) {
            return redirect()->route('candidato.create');
        }

        // Cargamos relaciones de la oferta
        $oferta->load(['empresa.sectores', 'puesto', 'sector', 'modalidad']);

        // Si no está publicada, no debería verse (opcional, según tu lógica)
        if ($oferta->estado !== 'publicada') {
            return redirect()->route('candidato.ofertas')->with('error', 'La oferta no está disponible.');
        }

        // ¿Está inscrito?
        $inscripcion = $candidato->ofertas()
            ->where('oferta_id', $oferta->id)
            ->first(); // devuelve Oferta con pivot o null

        $yaInscrito = (bool) $inscripcion;

        return view('candidato.oferta_show', [
            'oferta' => $oferta,
            'yaInscrito' => $yaInscrito,
            'pivot' => $inscripcion?->pivot, // por si quieres mostrar estado/fecha
        ]);
    }


}