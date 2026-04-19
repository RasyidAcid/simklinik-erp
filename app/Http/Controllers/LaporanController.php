<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
   public function index()
{
    return Inertia::render('Laporan/Index');
}

public function rekeningPdf()
{
    $data = Rekening::all();

    $pdf = Pdf::loadView('pdf.rekening', [
        'data' => $data
    ]);

    return $pdf->stream('laporan-rekening.pdf'); // VIEW
}

public function rekeningDownload()
{
    $data = Rekening::all();

    $pdf = Pdf::loadView('pdf.rekening', [
        'data' => $data
    ]);

    return $pdf->download('laporan-rekening.pdf'); // DOWNLOAD
}
}