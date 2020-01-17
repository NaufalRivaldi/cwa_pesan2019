<?php

namespace App\Http\Controllers\PKK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PKK\DetailPoling;
use DB;
use App\PKK\Periode;

class LaporanHasilPolingController extends Controller
{
    public function index()
    {
        $skor = 0;
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
        $data['searchPeriode'] = Periode::orderBy('id', 'DESC')->get();
        return view('admin.laporan.hrd.laporanhasilpoling.index', $data);
    }

    public function detail()
    {        
        $data['menu'] = '9';
        $data['no'] = 1;
        if (isset($_GET['periodeId'])) {
            $data['hasilPoling'] = DetailPoling::select('karyawanId', DB::raw('COUNT(karyawanId) as skor'))->groupBy('karyawanId')->whereHas('poling', function($query) use ($periodeId){
                $query->where('periodeId', $periodeId);
            })->orderBy('skor', 'DESC')->get();
        } else {    
            $periodeId = Periode::orderBy('id', 'DESC')->first();          
            $data['hasilPoling'] = DetailPoling::select('karyawanId', DB::raw('COUNT(karyawanId) as skor'))->groupBy('karyawanId')->whereHas('poling', function($query) use ($periodeId){
                $query->where('periodeId', $periodeId->id);
            })->orderBy('skor', 'DESC')->get();
        }

        return view('admin.laporan.hrd.laporanhasilpoling.detail', $data);
    }

}
