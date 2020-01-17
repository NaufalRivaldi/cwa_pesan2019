<?php

namespace App\Exports;

use App\PKK\DetailPoling;
use App\PKK\Periode;
use DB;
use App\Helpers\helper;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class HasilPolingExport implements FromView
{
    use Exportable;
    public function view(): View{
        $data['menu'] = '9';
        $data['no'] = 1;
        $data['dep'] = [
            'Accounting',
            'Finance',
            'Gudang',
            'HRD',
            'IT',
            'GA',
            'MT',
            'PAJAK',
            'QA',
            'SCM'
        ];
        $dep = $data['dep'];
        $data['periode'] = Periode::orderBy('id', 'DESC')->first();
        if (isset($_GET['periodeId'])) {            
            $periodeId = $_GET['periodeId'];
            $data['hasilPoling'] = DetailPoling::select('karyawanId', DB::raw('COUNT(karyawanId) as skor'))->groupBy('karyawanId')->whereHas('poling', function($query) use ($periodeId){
                $query->where('periodeId', $periodeId);
            })->orderBy('skor', 'DESC')->get();
        } else {    
            $periodeId = Periode::orderBy('id', 'DESC')->first();          
            $data['hasilPoling'] = DetailPoling::select('karyawanId', DB::raw('COUNT(karyawanId) as skor'))->groupBy('karyawanId')->whereHas('poling', function($query) use ($periodeId){
                $query->where('periodeId', $periodeId->id);
            })->orderBy('skor', 'DESC')->get();
        }

        return view('admin.laporan.hrd.laporanhasilpoling.export', $data);
    }
}
