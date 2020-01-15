<?php

namespace App\Http\Controllers\PKK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PKK\DetailPoling;
use DB;
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

        return view('admin.laporan.hrd.laporanhasilpoling.index', $data);
    }


    public function detail()
    {        
        $data['menu'] = '9';
        $data['no'] = 1;
        $data['hasilPoling'] = DetailPoling::select('karyawanId', DB::raw('COUNT(karyawanId) as skor'))->groupBy('karyawanId')->orderBy('skor', 'DESC')->get();               

        return view('admin.laporan.hrd.laporanhasilpoling.detail', $data);
    }

}
