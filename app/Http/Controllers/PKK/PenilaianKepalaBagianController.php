<?php

namespace App\Http\Controllers\PKK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PenilaianKabagRequest;

use App\KaryawanAll;
use App\PKK\Indikator;
use App\PKK\Kuisioner;
use App\PKK\Periode;
use App\PKK\Penilaian;
use App\PKK\DetailPenilaian;
use App\PKK\DetailIndikator;
use App\PKK\DetailKuisioner;

use Auth;

class PenilaianKepalaBagianController extends Controller
{
    public function index(Request $req){
        $data['menu'] = '12';
        $dep = [
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
        $dateNow = date('Y-m-d');
        $karyawan = KaryawanAll::where('nik', $req->nik)->where('stat', 1)->whereIn('dep', $dep)->first();
        $periode = Periode::where('status', 1)->where('tglMulai', '<', $dateNow)->where('tglSelesai', '>', $dateNow)->first();
        $data['indikator'] = Indikator::where('kategori', 2)->where('status', 1)->get();
        $data['kuisioner'] = Kuisioner::where('kategori', 2)->where('status', 1)->get();

        if(!empty($karyawan)){
            if(!empty($periode)){
                $penilaian = Penilaian::where('karyawanId', $karyawan->id)->where('periodeId', $periode->id)->first();
                if(empty($penilaian)){
                    $data['karyawan'] = $karyawan;
                    $data['kabag'] = $karyawan::where('stat', 2)->where('dep', $karyawan->dep)->first();
                    $data['periode'] = $periode;
                    return view('admin.pkk.penilaian.kabag.form', $data);
                }else{
                    return redirect()->route('pkk.penilaian')->with('error', 'NIK sudah pernah melakukan poling!');
                }
            }else{
                return redirect()->route('pkk.penilaian')->with('error', 'Periode tidak valid!');
            }
        }else{
            return redirect()->route('pkk.penilaian')->with('error', 'Anda tidak memiliki akses.');
        }
    }

    public function store(PenilaianKabagRequest $req){
        Penilaian::create([
            'karyawanId' => $req->karyawanId,
            'userId' => Auth()->user()->id,
            'periodeId' => $req->periodeId,
            'status' => 1,
            'kategori' => 2
        ]);

        $penilaian = Penilaian::orderBy('id', 'desc')->first();
        DetailPenilaian::create([
            'penilaianId' => $penilaian->id,
            'karyawanId' => $req->kabagId
        ]);

        $detailPenilaian = DetailPenilaian::orderBy('id', 'desc')->first();
        $idx = 0;
        foreach($req->indikatorId as $indikator){
            DetailIndikator::create([
                'detailPenilaianId' => $detailPenilaian->id,
                'indikatorId' => $indikator,
                'nilai' => $req->indikatorValue[$idx++]
            ]);
        }

        $idx = 0;
        foreach($req->kuisionerId as $kuisioner){
            DetailKuisioner::create([
                'detailPenilaianId' => $detailPenilaian->id,
                'kuisionerId' => $kuisioner,
                'jawaban' => $req->jawaban[$idx++]
            ]);
        }

        return  redirect()->route('pkk.penilaian')->with('success', 'Anda sudah melakukan poling.');
    }
}