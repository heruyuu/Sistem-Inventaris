<?php

namespace App\Http\Controllers;

use App\Models\Comodities;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generatePDF()
    {
        $comodities = Comodities::all();
        $toko = env('Nama_Toko', 'Barang Milik Toko');
        $pdf = PDF::loadView('pages.comodities.pdf', compact(['comodities', 'toko']))->setPaper('a4');
        return $pdf->download('print.pdf');
    }

    public function generatePDFOne($id)
    {
        $comodities = Comodities::find($id);
        $toko = env('Nama_Toko', 'Barang Milik Toko');
        $pdf = PDF::loadView('pages.comodities.pdfone', compact(['comodities','toko']))->setPaper('a4');
        return $pdf->download('print.pdf');
    }
}
