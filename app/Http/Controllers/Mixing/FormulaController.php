<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormulaRequest;

use App\Merk;
use App\Formula;

class FormulaController extends Controller
{
    public function index(){
        $data['no'] = 1;
        $data['formula'] = Formula::groupBy('merkId')->get();
        
        return view('formula.index', $data);
    }

    public function detail($id){
        $data['no'] = 1;
        $data['formula'] = Formula::where('merkId', $id)->orderBy('id', 'asc')->get();
        $data['merk'] = Merk::find($id);
        
        return view('formula.detail', $data);
    }

    public function form(){
        $data['merk'] = Merk::orderBy('name', 'asc')->get();
        
        return view('formula.form', $data);
    }

    public function edit(){
        $id = $_GET['id'];
        $data['formula'] = Formula::find($id);
        $data['merk'] = Merk::orderBy('name', 'asc')->get();        
        return view('formula.form', $data);
    }

    public function formByMerk($merkId){
        $data['merk'] = Merk::find($merkId);
        return view('formula.formbymerk', $data);
    }

    public function add(FormulaRequest $req){
        Formula::create([
            'color' => $req->color,
            'merkId' => $req->merkId
        ]);

        return redirect()->route('formula.detail', ['id'=>$req->merkId])->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(FormulaRequest $req){
        $data = Formula::find($req->id);
        $merkId = $data->merkId;
        $data->merkId = $req->merkId;
        $data->color = $req->color;
        $data->save();
    
        return redirect()->route('formula.detail', ['id'=>$merkId])->with('success', 'Data berhasil di update.');
    }

    public function delete(Request $req){
        $data = Formula::find($req->id);
        $data->delete();

        return redirect()->route('formula')->with('success', 'Data berhasil di hapus.');
    }
}
