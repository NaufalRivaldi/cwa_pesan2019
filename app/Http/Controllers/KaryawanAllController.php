<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\KaryawanAllImport;
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
        $data['dep'] = $this->dep();

        return view('backend.karyawan.index', compact('no', 'data'));
    }

    public function edit($id){
        $data['title'] = 'Edit Karyawan';
        $karyawan = KaryawanAll::find($id);
        $data['cabang'] = Cabang::orderBy('inisial', 'desc')->get();
        $data['dep'] = $this->dep();

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

    public function dep(){
        $data = array(
            'CW1',
            'CW2',
            'CW3',
            'CW4',
            'CW5',
            'CW6',
            'CW7',
            'CW8',
            'CW9',
            'CA0',
            'CA1',
            'CA2',
            'CA3',
            'CA4',
            'CA5',
            'CA6',
            'CA7',
            'CA8',
            'CA9',
            'CS1',
            'CL1',
            'HRD',
            'Finance',
            'Accounting',
            'Pajak',
            'QA',
            'GA',
            'IT',
            'SCM',
            'Gudang',
            'MT',
            'Office'
        );

        return $data;
    }
}
