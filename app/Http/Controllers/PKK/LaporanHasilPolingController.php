<?php

namespace App\Http\Controllers\PKK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\HasilPolingExport;

use App\PKK\DetailPoling;
use DB;
use App\PKK\Periode;
use App\PKK\Poling;
use App\KaryawanAll;

class LaporanHasilPolingController extends Controller
{
    public function index()
    {
        $skor = 0;
        $data['menu'] = '9';
        $data['no'] = 1;        
        $data['dep'] = $this->dep();
        $dep = $this->dep();
        $data['searchPeriode'] = Periode::orderBy('id', 'DESC')->where('kategori', 1)->get();
        $data['persentase'] = $this->persentase();
        return view('admin.laporan.hrd.laporanhasilpoling.index', $data);
    }

    public function detail()
    {        
        $data['menu'] = '9';
        $data['no'] = 1;
        if (isset($_GET['periodeId'])) {
            $periodeId = $_GET['periodeId'];
            $data['hasilPoling'] = DetailPoling::select('karyawanId', DB::raw('COUNT(karyawanId) as skor'))->groupBy('karyawanId')->whereHas('poling', function($query) use ($periodeId){
                $query->where('periodeId', $periodeId);
            })->orderBy('skor', 'DESC')->get();
        } else {    
            $periodeId = Periode::orderBy('id', 'DESC')->where('kategori', 1)->first();          
            $data['hasilPoling'] = DetailPoling::select('karyawanId', DB::raw('COUNT(karyawanId) as skor'))->groupBy('karyawanId')->whereHas('poling', function($query) use ($periodeId){
                $query->where('periodeId', $periodeId->id);
            })->orderBy('skor', 'DESC')->get();
        }

        return view('admin.laporan.hrd.laporanhasilpoling.detail', $data);
    }

    public function export()
    {
        return (new HasilPolingExport)->download('data-hasil-poling.xlsx');
    }

    public function persentase(){
        $dep = $this->dep();
        $karyawan = KaryawanAll::where('stat', 1)->where('ket', 1)->whereIn('dep', $dep)->get();
        if($_GET){
            $periode = Periode::find($_GET['periodeId']);
        }else{
            $periode = Periode::where('kategori', 1)->orderBy('id', 'desc')->first();
        }
        $poling = Poling::where('kategori', 1)->where('periodeId', $periode->id)->get();

        $total = ($poling->count() / $karyawan->count()) * 100;
        
        return round($total);
    }

    public function dep(){
        $dep = [
            'Accounting',
            'Finance',
            'HRD',
            'IT',
            'GA',
            'MT',
            'PAJAK',
            'QA',
            'SCM'
        ];

        return $dep;
    }
}
