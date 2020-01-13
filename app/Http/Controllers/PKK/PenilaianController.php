<?php

namespace App\Http\Controllers\PKK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\KaryawanAll; 

class PenilaianController extends Controller
{
    public function index()
    {
        $data['menu'] = '12';

        return view('admin.pkk.penilaian.index', $data);
    }

    public function poling(Request $req){
        $data['menu'] = '12';
        $data['no'] = 1;
        $data['dep'] = [
            'Accounting',
            'Finance',
            'Gudang',
            'HRD',
            'IT',
            'MT',
            'PAJAK',
            'QA',
            'SCM'
        ];
        $dep = $data['dep'];
        $karyawan = KaryawanAll::where('nik', $req->nik)->where('stat','1')->whereIn('dep', $dep)->first();
        if (!empty($karyawan)) {
            $data['karyawan'] = $karyawan;
            return view('admin.pkk.penilaian.poling', $data);
        } else {
            return redirect()->route('pkk.penilaian')->with('error', 'Anda tidak memiliki hak akses!');
        }
    }
}
