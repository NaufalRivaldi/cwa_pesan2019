<?php

namespace App\Http\Controllers\Forms\Cuti;

use App\Http\Requests\CutiRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Forms\formcuti\FormCuti;
use App\KaryawanAll;
use App\Forms\formcuti\KategoriCuti;

class CutiController extends Controller
{
    public function index()
    {
        $data['menu'] = '13';
        $data['no'] = 1;
        $data['cuti'] = FormCuti::all();
        return view('admin.form.hrd.formcuti.cuti.index', $data);
    }

    public function form()
    {
        $data['menu'] = 13;
        $data['karyawan'] = KaryawanAll::orderBy('nama', 'asc')->get();
        $data['kategori'] = KategoriCuti::orderBy('id', 'asc')->get();

        return view('admin.form.hrd.formcuti.cuti.form', $data);
    }

    public function cekKaryawan()
    {
        $id = $_GET['id'];   
        $month = 12;
        $date = date('Y-m-d');     
        $data = KaryawanAll::find($id);

        if (empty($data)) {
            return '0';
        } else {            
            $masaKerja = $data->masaKerja;
            $diff = date_diff(date_create($masaKerja), date_create($date));
        }
        

        $bulanKerja = date("n", strtotime($data->masaKerja));
        $sisaCuti = $month - $bulanKerja;


        $array = [
            'y' => $diff->y,
            'm' => $diff->m,
            'd' => $diff->d,
            'sisaCuti' => $sisaCuti
        ];

        return $array;
    }

    public function cekBulan()
    {
        $id = $_GET['id'];
        $data = KaryawanAll::find($id); 

        return $sisaCuti;
    }

    public function fillCuti()
    {
        $id = $_GET['id'];
        $data = KategoriCuti::find($id);
        
        return $data;
    }

    public function add(CutiRequest $req)
    {
        FormCuti::create([
            'idKaryawanAll'=>$req->idKaryawanAll,
            'idKategori'=>$req->idKategori,
            'cuti'=>$req->cuti,
            'sisaCuti'=>$req->sisaCuti,
            'periode'=>$req->periode
        ]);

        return redirect()->route('form.hrd.cuti')->with('success', 'Data berhasil ditambah!');
    }
}
