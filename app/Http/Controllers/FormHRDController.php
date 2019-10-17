<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\FormHRD;
use App\KaryawanAll;

class FormHRDController extends Controller
{
    public function index(){
        $menu = 8;
        $no = 1;
        $form = FormHRD::orderBy('created_at', 'desc')->get();

        return view('admin.form.hrd.index', compact('menu', 'no', 'form'));
    }

    public function form(){
        $menu = 8;
        $karyawan = KaryawanAll::where('dep', auth()->user()->dep)->get();
        $kategori = $this->kategori();

        return view('admin.form.hrd.form', compact('menu', 'karyawan', 'kategori'));
    }

    public function detail($id){
        $menu = 8;
        $form = FormHRD::find($id);

        return view('admin.form.hrd.detail', compact('menu', 'form'));
    }

    public function store(Request $req){
        $this->val($req);

        FormHRD::create([
            'kategori' => implode(',', $req->kategori),
            'tgl_a' => $req->tgl_a,
            'tgl_b' => $req->tgl_b,
            'keterangan' => $req->keterangan,
            'stat' => '1',
            'user_id' => auth()->user()->id,
            'karyawan_all_id' => $req->karyawanall_id
        ]);

        return redirect('/admin/formhrd')->with('status', 'formhrd-success');
    }

    // function tambahan
    private function kategori(){
        $kategori = array(
            '1' => 'Terlambat',
            '2' => 'Dinas Keluar',
            '3' => 'Izin Tidak Masuk Kerja',
            '4' => 'Tidak Absen',
            '5' => 'Pelanggaran',
            '6' => 'Izin Keluar/Pulang',
            '7' => 'Lembur',
            '8' => 'Dll'
        );

        return (object) $kategori;
    }

    private function val($req){
        $message = [
            'required' => ':attribut tidak boleh kosong!'
        ];

        $this->validate($req, [
            'kategori' => 'required',
            'karyawanall_id' => 'required',
            'tgl_a' => 'required',
            'keterangan' => 'required'
        ], $message);
    }
}
