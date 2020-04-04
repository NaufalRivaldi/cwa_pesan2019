<?php

namespace App\Http\Controllers\PKK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PKK\PenilaianEmployee;
use App\PKK\Periode;
use App\KaryawanAll;

use DB;

class LaporanBestEmployeeController extends Controller
{
    public function index(){
        $data['menu'] = 9;
        $periode = Periode::where('status', '1')->where('kategori', '1')->orderBy('id', 'desc')->first();
        $data['periode'] = Periode::where('status', '1')->where('kategori', '1')->get();
        if($_GET){
            $data['persentase'] = (PenilaianEmployee::groupBy('userId')->where('periodeId', $_GET['periodeId'])->get()->count() / 8) * 100;
            $data['penilaian'] = PenilaianEmployee::select('*', DB::raw('sum(total) as totalSkor'))->groupBy('karyawanId')->where('periodeId', $_GET['periodeId'])->get();
        }else{
            $data['persentase'] = (PenilaianEmployee::groupBy('userId')->get()->count() / 8) * 100;
            $data['penilaian'] = PenilaianEmployee::select('*', DB::raw('sum(total) as totalSkor'))->groupBy('karyawanId')->where('periodeId', $periode->id)->get();
        }

        return view('admin.laporan.hrd.bestemployee.index', $data);
    }

    public function view($periodeId, $karyawanId){
        $data['menu'] = 9;
        $data['penilaian'] = PenilaianEmployee::where('periodeId', $periodeId)->where('karyawanId', $karyawanId)->get();
        $data['karyawan'] = KaryawanAll::find($karyawanId);
        
        return view('admin.laporan.hrd.bestemployee.view', $data);
    }

    public function reset(Request $request){
        PenilaianEmployee::where('periodeId', $request->periodeId)->delete();
        
        return redirect()->route('laporan.hrd.penilaian.bestemp')->with('success', 'Data berhasil di reset!');
    }
}
