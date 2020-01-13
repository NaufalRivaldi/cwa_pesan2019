<?php

namespace App\Http\Controllers\PKK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PKK\Kuisioner;

class KuisionerController extends Controller
{
    public function index(){
        $data['menu'] = '12';
        $data['no'] = '1';
        $data['kuisioner'] = Kuisioner::all();
        return view('admin.pkk.kuisioner.index', $data);
    }

    public function form(){
        $data['menu'] = '12';
        return view('admin.pkk.kuisioner.form', $data);
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

    public function add(Request $req){
        $this->val($req);
        Kuisioner::create([
            'pertanyaan'=>$req->pertanyaan,
            'status'=>1,
            'kategori'=>$req->kategori
        ]);

        return redirect()->route('pkk.kuisioner')->with('success', 'Data berhasil ditambah!');
    }

    public function edit()
    {
        $id = $_GET['id'];
        $data['menu'] = '12';
        $data['kuisioner'] = Kuisioner::find($id);

        return view('admin.pkk.kuisioner.form', $data);
    }

    public function update(Request $req)
    {
        $this->val($req);
        $data = Kuisioner::find($req->id);
        $data->pertanyaan = $req->pertanyaan;
        $data->kategori = $req->kategori;

        $data->save();

        return redirect()->route('pkk.kuisioner')->with('success', 'Data berhasil diubah!');
    }
}
