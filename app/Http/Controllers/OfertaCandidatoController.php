<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\Oferta;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class OfertaCandidatoController extends Controller
{
    public function downloadCv(Candidato $candidato)
    {
        if (empty($candidato->cv)) {
            abort(404, 'El candidato no tiene CV');
        }

        // Si guardas en storage/app/public/... suele venir como 'cvs/archivo.pdf'
        $disk = 'public';
        $path = $candidato->cv;

        if (!Storage::disk($disk)->exists($path)) {
            abort(404, 'CV no encontrado en el almacenamiento');
        }

        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $filename = 'CV_' . trim($candidato->nombre . '_' . $candidato->apellidos) . '.' . ($ext ?: 'pdf');
        $filename = preg_replace('/\s+/', '_', $filename);

        return Storage::disk($disk)->download($path, $filename);
    }

    public function downloadAllCvsZip(Oferta $oferta)
    {
        // Carga candidatos asociados a la oferta
        $candidatos = $oferta->candidatos()->get();

        $disk = 'public';
        $paths = $candidatos
            ->filter(fn($c) => !empty($c->cv) && Storage::disk($disk)->exists($c->cv))
            ->values();

        if ($paths->isEmpty()) {
            abort(404, 'No hay CV disponibles para descargar');
        }

        $zipName = 'CVs_Oferta_' . $oferta->id . '.zip';
        $zipPath = storage_path('app/tmp/' . $zipName);

        if (!is_dir(dirname($zipPath))) {
            mkdir(dirname($zipPath), 0775, true);
        }

        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            abort(500, 'No se pudo crear el ZIP');
        }

        foreach ($paths as $c) {
            $path = $c->cv;
            $abs = Storage::disk($disk)->path($path);

            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $base = 'CV_' . trim($c->nombre . '_' . $c->apellidos);
            $base = preg_replace('/\s+/', '_', $base);

            $zip->addFile($abs, $base . '.' . ($ext ?: 'pdf'));
        }

        $zip->close();

        return response()->download($zipPath, $zipName)->deleteFileAfterSend(true);
    }
}
