<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\FormHRD;
use App\KategoriHRD;
use App\SetKategoriHRD;
use App\KaryawanAll;

class FormHRDController extends Controller
{
    public function index(){
        $menu = 8;
        $no = 1;
        $form = FormHRD::whereHas('user', function($query){
            $query->whereDep(auth()->user()->dep);
        })->orderBy('created_at', 'desc')->get();

        return view('admin.form.hrd.index', compact('menu', 'no', 'form'));
    }

    public function form(){
        $menu = 8;
        $karyawan = KaryawanAll::where('dep', auth()->user()->dep)->get();
        $kategori = KategoriHRD::all();

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
            'tgl_a' => $req->tgl_a,
            'tgl_b' => $req->tgl_b,
            'keterangan' => $req->keterangan,
            'stat' => '1',
            'user_id' => auth()->user()->id,
            'karyawan_all_id' => $req->karyawanall_id
        ]);

        // set kategori
        $form = FormHRD::orderBy('id', 'desc')->first();
        $this->setKategori($req->kategori, $form->id);

        return redirect('/admin/formhrd')->with('status', 'formhrd-success');
    }

    public function accspv(Request $req, $form_id){
        $this->valSpv($req);
        $nik = $req->nik;
        $password = sha1($req->password);
        $dep = $req->dep;
        $karyawan = KaryawanAll::where('nik', $nik)->where('password', $password)->where('dep', $dep)->first();
        
        if(isset($karyawan)){
            $form = FormHRD::find($form_id);
            $form->stat = '2';
            $form->save();

            return redirect()->back()->with('status', 'form-success');
        }

        return redirect()->back()->with('status', 'form-error');
    }

    // function tambahan
    public function setKategori($kategori, $no_form){
        for($i = 0; $i < count($kategori); $i++){
            SetKategoriHRD::create([
                'kategori_fhrd_id' => $kategori[$i],
                'form_hrd_id' => $no_form
            ]);
        }
    }

    private function val($req){
        $message = [
            'required' => ':attribute tidak boleh kosong!'
        ];

        $this->validate($req, [
            'kategori' => 'required',
            'karyawanall_id' => 'required',
            'tgl_a' => 'required',
            'keterangan' => 'required'
        ], $message);
    }

    private function valSpv($req){
        $message = [
            'required' => ':attribute tidak boleh kosong!',
            'min' => ':attribute tidak valid'
        ];

        $this->validate($req, [
            'nik' => 'required|min:8',
            'password' => 'required'
        ], $message);
    }
}
