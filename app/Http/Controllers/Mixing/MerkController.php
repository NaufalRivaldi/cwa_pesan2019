<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merk;

class MerkController extends Controller
{
    public function index(){
        $data['merks'] = Merk::all();
        $data['no'] = 1;
        return view('merk.index', $data);
    }

    public function form(){
        return view('merk.form');
    }

    public function val($req){
        $msg = [
            'required' => 'Kolom ini tidak boleh kosong!'
        ];

        $this->validate($req, [
            'name' => 'required'
        ]);
    }
    
    public function add(Request $req){
        $this->val($req);
        Merk::create([
            'name'=>$req->name
        ]);

        return redirect()->route('merk')->with('success', 'Data berhasil ditambah!');        
    }

    public function edit(){
        $id = $_GET['id'];
        $data['merk'] = Merk::find($id);        
        return view('merk.form', $data);
    }

    public function update(Request $req){
        $this->val($req);
        $data = Merk::find($req->id);
        $data->name=$req->name;
        $data->save();

        return redirect()->route('merk')->with('success', 'Data berhasil diubah!');
    }

    public function delete(Request $req){
        $data = Merk::find($req->id);
        $data->delete();
    }
}
