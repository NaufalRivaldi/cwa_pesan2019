<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\KaryawanAllImport;
use App\Helpers\helper;
use Maatwebsite\Excel\Facades\Excel;

use App\KaryawanAll;
use App\Cabang;

class KaryawanAllController extends Controller
{
    public function index(){
        $no = 1;
        $data['title'] = 'Karyawan';
        $data['karyawan'] = KaryawanAll::orderBy('dep', 'asc')->get();
        $data['cabang'] = Cabang::orderBy('inisial', 'desc')->get();
        $data['dep'] = helper::allDep();

        return view('backend.karyawan.index', compact('no', 'data'));
    }

    public function edit($id){
        $data['title'] = 'Edit Karyawan';
        $karyawan = KaryawanAll::find($id);
        $data['cabang'] = Cabang::orderBy('inisial', 'desc')->get();
        $data['dep'] = helper::allDep();

        return view('backend.karyawan.form', compact('no', 'data', 'karyawan'));
    }

    public function save(Request $req){
        $this->val($req);

        KaryawanAll::create([
            "nik" => $req->nik,
            "password" => sha1($req->nik),
            "nama" => $req->nama,
            "dep" => $req->dep,
            "stat" => $req->stat
        ]);

        return redirect('/backend/karyawan')->with('status', 'simpan-success');
    }

    public function import(Request $req){
        $this->validate($req, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $req->file('file');
        $nama_file = rand().$file->getClientOriginalName();
        $file->move('file-karyawan',$nama_file);
        Excel::import(new KaryawanAllImport, public_path('/file-karyawan/'.$nama_file));
        
        return redirect()->route('karyawan.all')->with('success', 'Data berhasil di import.');
    }

    public function update(Request $req){
        $this->val($req);
        $karyawan = KaryawanAll::find($req->id);
        $karyawan->nik = $req->nik;
        $karyawan->nama = $req->nama;
        $karyawan->dep = $req->dep;
        $karyawan->stat = $req->stat;

        $karyawan->save();

        return redirect('/backend/karyawan');
    }

    public function reset($id){
        $karyawan = KaryawanAll::find($id);
        $karyawan->password = sha1($karyawan->nik);
        $karyawan->save();

        return redirect('/backend/karyawan')->with('success', 'Password sudah di reset.');
    }

    public function delete($id){
        $karyawan = KaryawanAll::find($id);
        $karyawan->delete();

        return redirect('/backend/karyawan');
    }

    public function val($req){
        $message = [
            "required" => ":attribute tidak boleh kosong!"
        ];

        $this->validate($req, [
            "nik" => "required|min:8",
            "nama" => "required|min:5|string",
            "dep" => "required",
            "stat" => "required"
        ], $message);
    }

    public function resetAll(){
        $karyawan = KaryawanAll::all();

        foreach($karyawan as $row){
            $set = KaryawanAll::find($row->id);
            $set->password = sha1($set->nik);
            $set->save();
        }

        echo "berhasil";
    }
}
