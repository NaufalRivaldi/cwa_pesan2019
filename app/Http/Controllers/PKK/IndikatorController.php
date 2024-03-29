<?php

namespace App\Http\Controllers\PKK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PKK\Indikator;

class IndikatorController extends Controller
{
    public function index()
    {
        $data['menu'] = '13';
        $data['no'] = '1';
        $kategori = '';
        if ($_GET) {
            $kategori = $_GET['kategori'];
        }
        $data['indikator'] = Indikator::where('kategori', 'like', '%'.$kategori.'%')->get();
        return view('admin.pkk.indikator.index', $data);
    }

    public function form()
    {
        $data['menu'] = '13';

        return view('admin.pkk.indikator.form', $data);
    }

    public function val($req)
    {
        $msg = [
            'required' => 'Kolom ini tidak boleh kosong!'
        ];

        $this->validate($req, [
            'pertanyaan' => 'required',
            'kategori' => 'required'
        ], $msg);
    }

    public function add(Request $req)
    {
        $this->val($req);
        Indikator::create([
            'pertanyaan'=>$req->pertanyaan,
            'status'=>1,
            'kategori'=>$req->kategori
        ]);

        return redirect()->route('pkk.indikator')->with('success', 'Data berhasil ditambah!');
    }

    public function edit()
    {
        $id = $_GET['id'];
        $data['menu'] = '13';
        $data['indikator'] = Indikator::find($id);

        return view('admin.pkk.indikator.form', $data);
    }

    public function update(Request $req)
    {
        $this->val($req);
        $data = Indikator::find($req->id);
        $data->pertanyaan = $req->pertanyaan;
        $data->kategori = $req->kategori;

        $data->save();

        return redirect()->route('pkk.indikator')->with('success', 'Data berhasil diubah!');
    }

    public function delete(Request $req)
    {
        $data = Indikator::find($req->id);
        $data->delete();
    }
}
