<?php

namespace App\Exports;

use App\PKK\DetailPenilaian;
use App\PKK\Periode;
use App\KaryawanAll;
use App\Helpers\helper;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;

class LaporanPenilaianKepalaBagianSheets implements FromView, WithTitle
{
    private $karyawanId;
    private $periodeId;

    public function __construct(string $karyawanId, int $periodeId, string $dep)
    {
        $this->karyawanId = $karyawanId;
        $this->periodeId  = $periodeId;
        $this->dep  = $dep;
    }
    
    use Exportable;
    public function view(): View{
        $periodeId = $this->periodeId;
        $karyawanId = $this->karyawanId;
        $periode = Periode::find($periodeId);
        $data['no'] = 1;

        $penilaian = DetailPenilaian::whereHas('penilaian', function($query) use ($periodeId){
            $query->where('periodeId', $periodeId);
        })->where('karyawanId', $karyawanId)->first();

        $data['penilaianFirst'] = $penilaian->detailIndikator;
        $data['detailKuisioner'] = $penilaian->detailKuisioner;
        $karyawan = KaryawanAll::find($karyawanId);
        $data['karyawan'] = $karyawan;
        $data['penilai'] = KaryawanAll::where('stat', 1)->where('dep', $karyawan->dep)->where('ket', 1)->get();
        $data['tlhMenilai'] = DetailPenilaian::where('karyawanId', $karyawan->id)->get();
        $data['periode'] = Periode::find($periodeId);

        return view('admin.laporan.hrd.penilaiankabag.export', $data);
    }

    public function title(): string
    {
        return $this->dep;
    }
}
