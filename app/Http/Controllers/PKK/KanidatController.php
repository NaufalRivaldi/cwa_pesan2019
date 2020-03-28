<?php

namespace App\Http\Controllers\PKK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PKK\Kanidat\KanidatRequest;
use App\Http\Requests\PKK\Kanidat\UpdateRequest;

use App\PKK\Poling;
use App\PKK\DetailPoling;
use App\PKK\Kanidat;
use App\KaryawanAll;
use App\PKK\Indikator;

use DB;
use Auth;

class KanidatController extends Controller
{
    public function edit($id){
        $data['menu'] = 12;
        $data['kanidat'] = Kanidat::find($id);

        return view('admin.laporan.hrd.kanidat.form', $data);
    }

    public function update(UpdateRequest $request){
        $data = Kanidat::find($request->id);
        $data->t = $request->t;
        $data->ip = $request->ip;
        $data->ik = $request->ik;
        $data->p = $request->p;
        $data->save();

        return redirect()->route('laporan.hrd.hasilpoling')->with('success', 'Kandidat berhasil diupdate.');
    }

    public function import($periodeId){
        $dep = $this->dep();
        $array = [];

        foreach($dep as $d){
            $data = DetailPoling::select('*', DB::raw('count(*) as skor'))->whereHas('poling', function($query) use ($periodeId){
                $query->where('periodeId', $periodeId);
            })->whereHas('karyawan', function($query) use ($d){
                $query->where('dep', $d);
            })->groupBy('karyawanId')->orderBy('skor', 'desc')->first();
    
            array_push($array, [
                "id" => $data->id,
                "karyawanId" => $data->karyawanId,
                "periodeId" => $periodeId,
                "skor" => $data->skor
            ]);
        }

        Kanidat::truncate();
        foreach($array as $row){
            Kanidat::create([
                'poin' => $row['skor'],
                'karyawanId' => $row['karyawanId'],
                'periodeId' => $row['periodeId'],
                't' => '0',
                'ip' => '0',
                'ik' => '0',
                'p' => '0'
            ]);
        }

        return redirect()->route('laporan.hrd.hasilpoling')->with('success', 'Kandidat berhasil diseleksi.');
    }

    public function destroy(Request $request){
        $data = Kanidat::find($request->id);
        $data->delete();
    }

    public function dep(){
        $dep = [
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

        return $dep;
    }
}
