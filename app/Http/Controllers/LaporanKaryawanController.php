<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\KaryawanRequest;
use App\Helpers\helper;

use App\KaryawanAll;

class LaporanKaryawanController extends Controller
{
    public function index(){
        $data['menu'] = 9;
        $data['no'] = 1;
        $dep = '';
        if ($_GET) {
            $dep = $_GET['dep'];
        }
        $data['karyawan'] = KaryawanAll::where('dep', 'like', '%'.$dep.'%')->orderBy('stat', 'desc')->get();

        return view('admin.laporan.hrd.karyawan.index', $data);
    }

    public function form(){
        $data['menu'] = 9;
        $data['departemen'] = helper::allDep();

        return view('admin.laporan.hrd.karyawan.form', $data);
    }

    public function edit($id){
        $data['menu'] = 9;
        $data['id'] = $id;
        $data['departemen'] = helper::allDep();
        $data['karyawan'] = KaryawanAll::find($id);

        return view('admin.laporan.hrd.karyawan.form', $data);
    }

    public function store(KaryawanRequest $req){
        KaryawanAll::create([
            'nik' => $req->nik,
            'password' => sha1($req->nik),
            'nama' => $req->nama,
            'dep' => $req->dep,
            'stat' => $req->stat,
            'ket' => 1
        ]);

        return redirect()->route('laporan.hrd.karyawan')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function update(KaryawanRequest $req){
        $data = KaryawanAll::find($req->id);
        $data->nik = $req->nik;
        $data->nama = $req->nama;
        $data->dep = $req->dep;
        $data->stat = $req->stat;
        $data->ket = 1;
        $data->save();

        return redirect()->route('laporan.hrd.karyawan')->with('success', 'Data karyawan berhasil diupdate.');
    }

    public function destroy(Request $req){
        $data = KaryawanAll::find($req->id);
        $data->delete();

        return redirect()->route('laporan.hrd.karyawan')->with('success', 'Data karyawan berhasil dihapus.');
    }

    public function aktif($id){
        $data = KaryawanAll::find($id);
        $data->ket = 1;
        $data->save();

        return redirect()->route('laporan.hrd.karyawan')->with('success', 'Data karyawan berhasil diupdate.');
    }

    public function nonaktif($id){
        $data = KaryawanAll::find($id);
        $data->ket = 2;
        $data->save();

        return redirect()->route('laporan.hrd.karyawan')->with('success', 'Data karyawan berhasil diupdate.');
    }
}
