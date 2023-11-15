<?php

namespace App\Imports\Comodities\Excel;

use App\Models\comodities;
use App\Models\ComodityLocation;
use App\Models\SchoolOperational;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Import implements ToModel, WithHeadingRow
{
    use Importable;
    private $school_operational;
    private $comodity_locations;

    public function __construct()
    {
        $this->school_operational = SchoolOperational::select('id','name','description')->get();
        $this->comodity_locations = ComodityLocation::select('id','name','description')->get();
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $comodity_location = $this->comodity_locations->where('name', $row['lokasi'])->first();
        $school_operation = $this->school_operational->where('name', $row['asal_perolehan'])->first();

        return new Comodities([
            'item_code'             => $row['kode_barang'],
            'name'                  => $row['nama_barang'],
            'brand'                 => $row['merek'],
            'material'              => $row['bahan'],
            'school_operational_id' => $school_operation->id ?? null,
            'comodity_locations_id' => $comodity_location->id ?? null,
            'date_of_purchase'      => $row['tahun_pembelian'],
            'condition'             => $this->checkComodityConditions($row['kondisi']),
            'quantity'              => $row['kuantitas'],
            'price'                 => $row['harga'],
            'price_per_item'        => $row['harga_satuan'],
            'note'                  => $row['keterangan']
        ]);
    }
    public function checkComodityConditions($condition)
    {
        if($condition === 'Baik') {
            $condition = 1;
        }elseif($condition === 'Kurang Baik') {
            $condition = 2;
        }else{
            $condition = 3;
        }

        return $condition;
    }
}
