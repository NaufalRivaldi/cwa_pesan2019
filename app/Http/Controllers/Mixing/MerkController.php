<?php

namespace App\Http\Controllers\Mixing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mixing\Merk;

class MerkController extends Controller
{
    public function index(){
        $data['menu'] = '11';
        $data['merks'] = Merk::all();
        $data['no'] = 1;
        return view('admin.mixing.merk.index', $data);
    }

    public function form(){
        $data['menu'] = '11';
        return view('admin.mixing.merk.form', $data);
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

        return redirect()->route('mixing.merk')->with('success', 'Data berhasil ditambah!');        
    }

    public function edit(){
        $data['menu'] = '11';
        $id = $_GET['id'];
        $data['merk'] = Merk::find($id);        
        return view('admin.mixing.merk.form', $data);
    }

    public function update(Request $req){
        $this->val($req);
        $data = Merk::find($req->id);
        $data->name=$req->name;
        $data->save();

        return redirect()->route('mixing.merk')->with('success', 'Data berhasil diubah!');
    }

    public function delete(Request $req){
        $data = Merk::find($req->id);
        $data->delete();
    }
}
