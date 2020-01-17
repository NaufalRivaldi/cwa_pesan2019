<?php

namespace App\Http\Controllers\PKK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PKK\DetailPenilaian;
use App\PKK\DetailKuisioner;
use App\PKK\Penilaian;
use App\PKK\Periode;
use App\KaryawanAll;

class LaporanPenilaianKabagController extends Controller
{
    public function index(){
        $data['menu'] = '12';
        $data['no'] = '1';
        
        $periode = Periode::where('kategori', 2)->orderBy('id', 'desc')->first();
        $data['penilaian'] = DetailPenilaian::whereHas('penilaian', function($query) use ($periode){
            $query->where('periodeId', $periode->id);
        })->groupBy('karyawanId')->get();

        $data['periode'] = $periode;

        return view('admin.laporan.hrd.penilaiankabag.index', $data);
    }

    public function detail($karyawanId, $periodeId){
        $data['menu'] = '12';
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

        return view('admin.laporan.hrd.penilaiankabag.detail', $data);
    }
}
