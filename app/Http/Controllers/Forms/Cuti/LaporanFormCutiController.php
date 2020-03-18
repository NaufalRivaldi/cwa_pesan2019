<?php

namespace App\Http\Controllers\Forms\Cuti;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forms\formcuti\FormCuti;
use App\Forms\formcuti\Cuti;
use App\Forms\formcuti\DetailFormCuti;

class LaporanFormCutiController extends Controller
{
    public function index()
    {
        $data['menu'] = '9';
        $data['no'] = '1';
        $data['formCuti'] = FormCuti::where('status', '>=', 4)->get();        
        
        $data['cuti'] = Cuti::groupBy('idKaryawan')->whereHas('karyawan', function($query){
            $query->orderBy('dep', 'asc');
        })->get();


        return view('admin.form.hrd.formcuti.laporan.index', $data);
    }

    public function viewCuti()
    {
        $id = $_GET['id'];
        $cuti = Cuti::where('id', $id)->groupBy('idKaryawan')->get();

        // $arr = [
        //     'namaKaryawan'=>$cuti->karyawan->nama,
        //     'departemen'=>$cuti->karyawan->dep,
        //     'kategori'=>$cuti->kategoriCuti->kategori,
        //     'periode'=>$cuti->periode,
        //     'status'=>$cuti->status,
        //     'sisaCuti'=>$cuti->sisaCuti
        // ];

        return $cuti;
    }
}
