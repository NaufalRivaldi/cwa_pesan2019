<?php

namespace App\Http\Controllers\PKK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PKK\Kanidat\KanidatRequest;
use App\Http\Requests\PKK\Bestemp\BestempRequest;

use App\KaryawanAll;
use App\PKK\Periode;
use App\PKK\Kanidat;
use App\PKK\Indikator;
use App\PKK\PenilaianEmployee;
use App\PKK\DetailPenilaianEmployee;

use Auth;

class PenilaianEmployeeController extends Controller
{
    public function index(){
        $data['menu'] = 12;
        $data['periode'] = Periode::orderBy('id', 'desc')->where('kategori', '1')->first();
        
        return view('admin.pkk.penilaian.bestemp.index', $data);
    }

    public function validasi(KanidatRequest $request){
        $nik = $request->nik;
        $password = sha1($request->password);
        $data = KaryawanAll::where('nik', $nik)->where('password', $password)->where('dep', Auth::user()->dep)->where('stat', '2')->first();
        
        if(!empty($data)){
            $kanidat = Kanidat::where('periodeId', $request->periodeId)->first();
            if(!empty($kanidat)){
                $penilaian = PenilaianEmployee::where('userId', Auth::user()->id)->where('periodeId', $request->periodeId)->first();
                
                if(empty($penilaian)){
                    return redirect()->route('pkk.bestemp.penilaian')->with('success', 'Verifikasi berhasil, '.$data->nama.', silahkan berikan penilaian.');
                }else{
                    return redirect()->route('pkk.bestemp.index')->with('error', 'Anda sudah menilai!');
                }
            }else{
                return redirect()->route('pkk.bestemp.index')->with('error', 'Kanidat tidak tersedia!');
            }
        }else{
            return redirect()->route('pkk.bestemp.index')->with('error', 'Verifikasi Gagal!');
        }
    }

    public function penilaian(){
        $data['menu'] = 12;
        $data['kanidat'] = Kanidat::all();
        $data['indikator'] = Indikator::where('status', 1)->where('kategori', 1)->get();

        return view('admin.pkk.penilaian.bestemp.penilaian', $data);
    }

    public function store(Request $request){
        $indikator = Indikator::where('status', 1)->where('kategori', 1)->get();

        for($i = 0; $i<count($request->karyawanId); $i++){
            $t = $request->t[$request->karyawanId[$i]];
            $ip = $request->ip[$request->karyawanId[$i]];
            $ik = $request->ik[$request->karyawanId[$i]];
            $p = $request->p[$request->karyawanId[$i]];
            $total = 0;
            $totalInd = 0;
            
            foreach($indikator as $ind){
                $totalInd += $request->ind[$request->karyawanId[$i]][$ind->id];
            }
            
            $total = $totalInd - ($t * 4) - ($p * 5);
            // dd($total);
            PenilaianEmployee::create([
                't' => $t,
                'ip' => $ip,
                'ik' => $ik,
                'p' => $p,
                'total' => $total,
                'karyawanId' => $request->karyawanId[$i],
                'periodeId' => $request->periodeId[$i],
                'userId' => Auth::user()->id
            ]);
            
            $penilaian = PenilaianEmployee::orderBy('id', 'desc')->first();
            foreach($indikator as $ind){
                DetailPenilaianEmployee::create([
                    'nilai' => $request->ind[$request->karyawanId[$i]][$ind->id],
                    'indikatorId' => $ind->id,
                    'penilaianEmployeeId' => $penilaian->id
                ]);
            }
        }

        return redirect()->route('pkk.bestemp.index')->with('success', 'Anda telah berhasil menilai kanidat calon best employee.');
    }
}
