<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cabang;

class CabangController extends Controller
{
    public function index(){
        $no = 1;
        $data['title'] = 'Cabang';
        $data['cabang'] = Cabang::orderBy('inisial', 'asc')->get();

        return view('backend.cabang.index', compact('no', 'data'));
    }

    public function edit($id){
        $data['title'] = 'Edit Cabang';
        $cabang = Cabang::find($id);

        return view('backend.cabang.form', compact('no', 'data', 'cabang'));
    }

    public function save(Request $req){
        $this->val($req);

        Cabang::create([
            "inisial" => $req->inisial,
            "nama_cabang" => $req->nama_cabang
        ]);

        return redirect('/backend/cabang')->with('status', 'simpan-success');
    }

    public function update(Request $req){
        $this->val($req);
        $cabang = Cabang::find($req->id);
        $cabang->inisial = $req->inisial;
        $cabang->nama_cabang = $req->nama_cabang;

        $cabang->save();

        return redirect('/backend/cabang');
    }

    public function delete($id){
        $cabang = Cabang::find($id);
        $cabang->delete();

        return redirect('/backend/cabang');
    }

    public function val($req){
        $message = [
            "required" => ":attribute tidak boleh kosong!"
        ];

        $this->validate($req, [
            "inisial" => "required",
            "nama_cabang" => "required|min:6|string"
        ], $message);
    }
}
