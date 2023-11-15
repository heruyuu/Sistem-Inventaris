<?php

namespace App\Exports\Comodities\Excel;

use App\Models\comodities;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class Export implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $comodities = comodities::all();
        return collect([
            $this->customProcessDataComoditiesToExcel($comodities)
        ]);
    }
    public function headings(): array
    {
        return [
            'No.',
            'Kode Barang',
            'Nama Barang',
            'Merek',
            'Bahan',
            'Asal Perolehan',
            'Lokasi',
            'Tahun Pembelian',
            'Kondisi',
            'Kuantitas',
            'Harga',
            'Harga Satuan',
            'Keterangan'
        ];
    }
    public function registerEvents(): array
    {
        return[
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:W1';
                $event->sheet->setAllBorders('thin')->egtDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            }
        ];
    }
    public function customProcessDataComoditiesToExcel($model)
    {
        foreach($model as $key => $comodity) {
            $data[$key]['no'] = $key + 1;
            $data[$key]['item_code'] = $comodity->item_code;
            $data[$key]['name'] = $comodity->name;
            $data[$key]['brand'] = $comodity->brand;
            $data[$key]['material'] = $comodity->material;
            $data[$key]['school_operational'] = $comodity->school_operational->name;
            $data[$key]['location'] = $comodity->comodity_locations->name;
            $data[$key]['date_of_purchase'] = $comodity->date_of_purchase;
            $data[$key]['condition'] = $this->checkComodityConditions($comodity);
            $data[$key]['quantity'] = $comodity->quantity;
            $data[$key]['price'] = $comodity->price;
            $data[$key]['price_per_item'] = $comodity->price_per_item;
            $data[$key]['note'] = $comodity->note;
        }

        return $data;
    }
    public function checkComodityConditions($comodity)
    {
        if($comodity->condition === 1) {
            $condition = 'Baik';
        }elseif($comodity->condition === 2) {
            $condition = 'Kurang Baik';
        }else{
            $condition = 'Rusak';
        }

        return $condition;
    }
}
