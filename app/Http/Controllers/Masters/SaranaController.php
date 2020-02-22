<?php

namespace App\Http\Controllers\Masters;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Master\Sarana\SaranaRequest;

use App\Sarana;

class SaranaController extends Controller
{
    public function index(){
        $data['no'] = 1;
        $data['menu'] = 13;
        $data['sarana'] = Sarana::all();

        return view('admin.master.sarana.index', $data);
    }

    public function form($id = null){
        $data['menu'] = 13;

        if(empty($id)){
            $data['sarana'] = (object)[
                'id' => '',
                'namaSarana' => ''
            ];
        }else{
            $data['sarana'] = Sarana::find($id);
        }

        return view('admin.master.sarana.form', $data);
    }

    public function store(SaranaRequest $req){
        Sarana::create([
            'namaSarana' => $req->namaSarana
        ]);

        return redirect()->route('master.sarana.index')->with('success', 'Data berhasil disimpan.');
    }

    public function update(SaranaRequest $req){
        $data = Sarana::find($req->id);
        $data->namaSarana = $req->namaSarana;
        $data->save();

        return redirect()->route('master.sarana.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(Request $req){
        $data = Sarana::find($req->id);
        $data->delete();
    }
}
