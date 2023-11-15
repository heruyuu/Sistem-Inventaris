<?php

namespace App\Http\Controllers;

use App\Exports\Comodities\Excel\Export;
use App\Imports\Comodities\Excel\Import;
use App\Models\Comodities;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ComodityExportImportController extends Controller
{
    public function export()
    {
        $comodities = Comodities::all();
        if(count($comodities) != 0) {
            return Excel::download(new Export, 'Daftar-Barang-'. date('d-m-Y'). '.xlsx');
            toastr()->error('Tidak ada Barang');
            return redirect()->back()->withInput();
        }
    }

    public function import()
    {
        try {
            Excel::import(new Import, request()->file('file'));
            toastr()->success('Import Barang Berhasil');
            return redirect()->back();
        } catch(QueryException $e) {
            toastr()->error('Gagal, Pastikan Import Data anda Sesuai');
            return redirect()->back();
        }
    }
}
