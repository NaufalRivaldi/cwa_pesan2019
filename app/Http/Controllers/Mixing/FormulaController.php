<?php

namespace App\Http\Controllers\Mixing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormulaRequest;

use App\Mixing\Merk;
use App\Mixing\Formula;

class FormulaController extends Controller
{
    public function index(){
        $data['menu'] = '13';
        $data['no'] = 1;
        $data['formula'] = Formula::groupBy('merkId')->get();
        
        return view('admin.mixing.formula.index', $data);
    }

    public function detail($id){
        $data['menu'] = '13';
        $data['no'] = 1;
        $data['formula'] = Formula::where('merkId', $id)->orderBy('id', 'asc')->get();
        $data['merk'] = Merk::find($id);
        
        return view('admin.mixing.formula.detail', $data);
    }

    public function form(){
        $data['menu'] = '13';
        $data['merk'] = Merk::orderBy('name', 'asc')->get();
        
        return view('admin.mixing.formula.form', $data);
    }

    public function edit(){
        $data['menu'] = '13';
        $id = $_GET['id'];
        $data['formula'] = Formula::find($id);
        $data['merk'] = Merk::orderBy('name', 'asc')->get();        
        return view('admin.mixing.formula.form', $data);
    }

    public function formByMerk($merkId){
        $data['menu'] = '13';
        $data['merk'] = Merk::find($merkId);
        $data['merkId'] = $merkId;
        return view('admin.mixing.formula.formbymerk', $data);
    }

    public function add(FormulaRequest $req){
        Formula::create([
            'color' => $req->color,
            'merkId' => $req->merkId
        ]);

        return redirect()->route('mixing.formula.detail', ['id'=>$req->merkId])->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(FormulaRequest $req){
        $data = Formula::find($req->id);
        $merkId = $data->merkId;
        $data->merkId = $req->merkId;
        $data->color = $req->color;
        $data->save();
    
        return redirect()->route('mixing.formula.detail', ['id'=>$merkId])->with('success', 'Data berhasil di update.');
    }

    public function delete(Request $req){
        $data = Formula::find($req->id);
        $data->delete();

        return redirect()->route('mixing.formula')->with('success', 'Data berhasil di hapus.');
    }
}
