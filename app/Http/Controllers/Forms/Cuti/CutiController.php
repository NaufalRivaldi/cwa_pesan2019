<?php

namespace App\Http\Controllers\Forms\Cuti;

use App\Http\Requests\CutiRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Forms\formcuti\Cuti;
use App\KaryawanAll;
use App\Forms\formcuti\KategoriCuti;

class CutiController extends Controller
{
    public function index()
    {
        $data['menu'] = '13';
        $data['no'] = 1;
        $data['cuti'] = Cuti::orderBy('id', 'asc')->get();
        $data['kategori'] = KategoriCuti::orderBy('id', 'asc')->get();

        return view('admin.form.hrd.formcuti.cuti.index', $data);
    }

    public function form($id=null)
    {
        $data['menu'] = 13;
        $data['karyawan'] = KaryawanAll::orderBy('nama', 'asc')->get();
        $data['kategori'] = KategoriCuti::orderBy('id', 'asc')->get();
        if (!empty($id)) {
            $data['cuti'] = Cuti::find($id);
        } else {                      
            $data['cuti'] = (object)[
                'id' => '',
                'idKaryawan' => '',
                'sisaCuti' => '',
                'periode' => '',
                'idKategori' => ''
            ];
        }

        return view('admin.form.hrd.formcuti.cuti.form', $data);
    }

    public function delete(Request $req)
    {
        $data = Cuti::find($req->id);
        $data->delete();
    }

    public function cekKaryawan()
    {
        $id = $_GET['id'];
        $date = date('Y-m-d');
        $yearNow = date('Y');     
        $karyawan = KaryawanAll::find($id);

        if (empty($karyawan)) {
            return '0';
        } else {            
            $masaKerja = $karyawan->masaKerja;
            $diff = date_diff(date_create($masaKerja), date_create($date));
            if ($diff->y >= 1) {                       
                $cuti = 12;            
                $formCuti = Cuti::where('idKaryawan', $karyawan->id)->first();
                // dd($formCuti);
                if (empty($formCuti)) {
                    $bulanKerja = date("n", strtotime($karyawan->masaKerja));
                    // $tahunKerja = date("Y", strtotime($karyawan->masaKerja));
                    $sisaCuti = $cuti - $bulanKerja;
                    if ($sisaCuti > 0) {
                        $sisaCuti;
                    } else {
                        $sisaCuti = 12;
                    }
                } else {
                    $sisaCuti = 12;
                } 
                
            } else {
                return '0';
            }
        }

        $array = [
            'y' => $diff->y,
            'm' => $diff->m,
            'd' => $diff->d,
            'sisaCuti' => $sisaCuti,
            'yearNow' => $yearNow
        ];

        return $array;
    }

    public function add(CutiRequest $req)
    {
        Cuti::create([
            'idKaryawan'=>$req->idKaryawan,
            'idKategori'=>$req->idKategori,
            'sisaCuti'=>$req->sisaCuti,
            'periode'=>$req->periode,
            'status'=>1
        ]);

        return redirect()->route('form.hrd.cuti')->with('success', 'Data berhasil ditambah!');
    }

    

    public function update(CutiRequest $req)
    {
        $data = Cuti::find($req->id);
        $data->idKaryawan=$req->idKaryawan;
        $data->idKategori=$req->idKategori;
        $data->sisaCuti=$req->sisaCuti;
        $data->periode=$req->periode;
        $data->save();

        return redirect()->route('form.hrd.cuti')->with('success', 'Data berhasil diperbarui!');
    }

    public function generate()
    {        
        $yearNow = date('Y');
        $date = date('Y-m-d');
        $karyawan = KaryawanAll::orderby('nama', 'asc')->get();
        $formCuti = Cuti::where('periode', $yearNow)->orderBy('id', 'desc')->first();
        if (empty($formCuti)) {
            foreach ($karyawan as $k) {            
                $diff = date_diff(date_create($k->masaKerja), date_create($date));
                $m = $diff->y*12+$diff->m;
                if ($m > 12) {                
                    Cuti::create([
                        'idKaryawan'=>$k->id,
                        'idKategori'=>1,
                        'sisaCuti'=>12,
                        'periode'=>$yearNow,
                        'status'=>1
                    ]);
                }
                
                if ($diff->y % 5 == 0) {
                    Cuti::create([
                        'idKaryawan'=>$k->id,
                        'idKategori'=>2,
                        'sisaCuti'=>5,
                        'periode'=>$yearNow,
                        'status'=>1
                    ]);
                }
            }            
        } else {
            return redirect()->route('form.hrd.cuti')->with('error', 'Periode cuti sudah tersedia!');
        }

        return redirect()->route('form.hrd.cuti')->with('success', 'Data berhasil diupdate!');
    }

    public function loadKaryawan(Request $req)
    {
        if($req->has('q')){
            $cari = $req->q;
        }else{
            $cari = '';
        }
        $data = KaryawanAll::where('nama', 'like', '%'.$cari.'%')->get();

        return response()->json($data);
    }
}
