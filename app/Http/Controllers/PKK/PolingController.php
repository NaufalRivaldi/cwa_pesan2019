<?php

namespace App\Http\Controllers\PKK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\KaryawanAll;
use App\PKK\Periode;
use App\PKK\Poling;
use App\PKK\DetailPoling;

class PolingController extends Controller
{
    public function index(Request $req){
        $data['menu'] = '12';
        $data['no'] = 1;
        $data['dep'] = [
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
        $dep = $data['dep'];
        $now = date('Y-m-d');
        $periode = Periode::where('status', '1')->where('kategori','1')->where('tglMulai', '<=', $now)->where('tglSelesai', '>=', $now)->first();
        $karyawan = KaryawanAll::where('nik', $req->nik)->where('stat','1')->where('ket','1')->where('statusPoling', '1')->whereIn('dep', $dep)->first();
        
        if (!empty($karyawan)) {                  
            if (!empty($periode)) { 
                $karyawanDone = Poling::where('karyawanId', $karyawan->id)->where('periodeId', $periode->id)->first();
                if (!empty($karyawanDone)) {
                    return redirect()->route('pkk.penilaian')->with('error', 'Anda sudah melakukan melakukan poling!');                
                }            
                $data['periode'] = $periode;     
                $data['karyawan'] = $karyawan;
                return view('admin.pkk.penilaian.poling', $data);
            } else {
                return redirect()->route('pkk.penilaian')->with('error', 'Periode poling belum dimulai!'); 
            }
        } else {
            return redirect()->route('pkk.penilaian')->with('error', 'Anda tidak memiliki hak akses!');
        }
    }

    public function add(Request $req){
        $userId = Auth()->user()->id;
        Poling::create([
            'karyawanId'=>$req->karyawanIds,
            'userId'=>$userId,
            'periodeId'=>$req->periodeIds,
            'status'=>1,
            'kategori'=>1
        ]);
        
        $data = Poling::orderBy('created_at', 'DESC')->first();
        foreach ($req->karyawanId as $karyawan) {
            DetailPoling::create([
                'polingId' => $data->id,
                'karyawanId' => $karyawan
            ]);
        }

        return redirect()->route('pkk.penilaian')->with('success', 'Terimakasih sudah melakukan poling!');
    }
}
