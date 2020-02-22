<?php

namespace App\Http\Controllers\PKK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PKK\Periode;

class PeriodeController extends Controller
{
    public function index(){        
        $data['menu'] = '13';
        $data['no'] = 1;
        $kategori = '';
        if ($_GET) {
            $kategori = $_GET['kategori'];
        }
        $data['periode'] = Periode::where('kategori', 'like', '%'.$kategori.'%')->orderBy('kategori', 'asc')->get();

        return view('admin.pkk.periode.index', $data);
    }

    public function form(){
        $data['menu'] = '13';
        return view('admin.pkk.periode.form', $data);
    }

    public function val($req){
        $msg = [
            'required' => 'Kolom ini tidak boleh kosong!'
        ];

        $this->validate($req, [
            'namaPeriode' => 'required',
            'tglMulai' => 'required',
            'tglSelesai' => 'required',
            'kategori' => 'required'
        ], $msg);
    }
    
    public function add(Request $req){
        $this->val($req);
        if (!empty($req->status)) {
            $status = $req->status;
            $periode = Periode::where('status', '1')->where('kategori', $req->kategori)->get();
            if (!empty($periode)) {
                foreach ($periode as $key) {
                    $key->status=2;
                    $key->save();
                }
            }
        } else {
            $status = 2;
        }
        Periode::create([
            'namaPeriode'=>$req->namaPeriode,
            'tglMulai'=>$req->tglMulai,
            'tglSelesai'=>$req->tglSelesai,
            'status'=>$status,
            'kategori'=>$req->kategori
        ]);

        return redirect()->route('pkk.periode')->with('success', 'Data berhasil ditambah!');
    }

    public function edit(){
        $data['menu'] = '13';
        $id = $_GET['id'];
        $data['periode'] = Periode::find($id);
        return view('admin.pkk.periode.form', $data);
    }

    public function update(Request $req){
        $this->val($req);
        $data = Periode::find($req->id);
        $data->namaPeriode = $req->namaPeriode;
        $data->tglMulai = $req->tglMulai;
        $data->tglSelesai = $req->tglSelesai;
        $data->kategori = $req->kategori;
        $data->save();

        return redirect()->route('pkk.periode')->with('success', 'Data berhasil diubah!');
    }

    public function status(Request $req){
        $data = Periode::find($req->id);        
        if ($data->status=='1') {            
            $data->status=2;
            $data->save();
        } else {
            $periode = Periode::where('status', '1')->where('kategori', $data->kategori)->get();
            if (!empty($periode)) {
                foreach ($periode as $key) {
                    $key->status=2;
                    $key->save();
                }
            }
            $data->status=1;
            $data->save();
        }
        
        return redirect()->route('pkk.periode')->with('success', 'Data berhasil diubah!');
    }

    public function delete(Request $req){
        $data = Periode::find($req->id);
        $data->delete();
    }
}
