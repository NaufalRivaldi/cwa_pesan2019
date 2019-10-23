<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\KaryawanAll;
use App\Cabang;

class KaryawanAllController extends Controller
{
    public function index(){
        $no = 1;
        $data['title'] = 'Karyawan';
        $data['karyawan'] = KaryawanAll::orderBy('nik', 'asc')->get();
        $data['cabang'] = Cabang::orderBy('inisial', 'desc')->get();
        $data['dep'] = $this->depOffice();

        return view('backend.karyawan.index', compact('no', 'data'));
    }

    public function edit($id){
        $data['title'] = 'Edit Karyawan';
        $karyawan = KaryawanAll::find($id);
        $data['cabang'] = Cabang::orderBy('inisial', 'desc')->get();
        $data['dep'] = $this->depOffice();

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
            "nama" => "required|min:6|string",
            "dep" => "required",
            "stat" => "required"
        ], $message);
    }

    public function depOffice(){
        $data = array(
            'IT', 'QA', 'HRD', 'Finance', 'Accounting', 'Pajak', 'GA', 'SCM', 'Gudang'
        );

        return $data;
    }
}