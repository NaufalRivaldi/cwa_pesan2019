<?php

namespace App\Exports;

use App\PKK\DetailPenilaian;
use App\PKK\Periode;
use App\Helpers\helper;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LaporanPenilaianKepalaBagian implements WithMultipleSheets
{
    use Exportable;

    /**
     * @return array
     */
    public function sheets(): array
    {
        if($_GET){
            $periode = Periode::find($_GET['periodeId']);            
            $dep = $_GET['dep'];
            $periodeId = $periode->id;    
        }else{
            $periode = Periode::where('kategori', 2)->where('status', 1)->orderBy('id', 'desc')->first();
            if (!empty($periode)) {
                $periodeId = $periode->id;
            }
            $dep = '';
        }

        $kbag = DetailPenilaian::whereHas('penilaian', function($query) use ($periodeId){
            $query->where('periodeId', $periodeId)->where('status', 1)->where('kategori', 2);
        })->groupBy('karyawanId')->get();

        $sheets = [];

        for ($i = 1; $i <= count($kbag); $i++) {
            $sheets[] = new LaporanPenilaianKepalaBagianSheets($kbag->karyawanId, $periodeId);
        }

        return $sheets;
    }
}
