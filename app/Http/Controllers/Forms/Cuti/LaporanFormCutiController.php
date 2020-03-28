<?php

namespace App\Http\Controllers\Forms\Cuti;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forms\formcuti\FormCuti;
use App\Forms\formcuti\Cuti;
use App\Forms\formcuti\DetailFormCuti;
use DB;

class LaporanFormCutiController extends Controller
{
    public function index()
    {
        $data['menu'] = '9';
        $data['no'] = '1';
        $data['formCuti'] = FormCuti::where('status', '>=', 4)->orderBy('id', 'desc')->get();        
        
        $data['cuti'] = Cuti::select('*', DB::raw('sum(sisaCuti) as sisa'))->groupBy('idKaryawan')->whereHas('karyawan', function($query){
            $query->orderBy('dep', 'asc');
        })->get();
        return view('admin.form.hrd.formcuti.laporan.index', $data);
    }

    public function detail($id)
    {
        $data['no'] = '1';
        $data['menu'] = '9';
        $data['cuti'] = Cuti::where('idKaryawan', $id)->select('*', DB::raw('sum(sisaCuti) as sisa'))->first();
        $data['detailCuti'] = DetailFormCuti::whereHas('formCuti', function($query) use ($id){
            $query->where('karyawanId', $id);
        })->get();
        // dd($data['detailCuti']);
        return view('admin.form.hrd.formcuti.laporan.detail', $data);
    }
}
