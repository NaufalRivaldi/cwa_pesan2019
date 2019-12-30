<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Merk;

class ProductController extends Controller
{
    public function index(){
        $data['products'] = Product::all();
        $data['no'] = 1;
        return view('product.index', $data);
    }

    public function form(){
        $data['merks'] = Merk::orderBy('name', 'ASC')->get();
        return view('product.form', $data);
    }

    public function val($req){
        $msg = [
            'required' => 'Kolom ini tidak boleh kosong!'
        ];

        $this->validate($req, [
            'merkId' => 'required',
            'name' => 'required'
        ], $msg);
    }

    public function add(Request $req){
        $this->val($req);
        Product::create([
            'merkId'=>$req->merkId,
            'name'=>$req->name
        ]);

        return redirect()->route('product')->with('success', 'Data berhasil ditambah!');
    }

    public function edit(){
        $id = $_GET['id'];
        $data['product'] = Product::find($id);
        $data['merks'] = Merk::orderBy('name', 'ASC')->get();
        return view('product.form', $data);
    }

    public function update(Request $req){
        $this->val($req);
        $data = Product::find($req->id);
        $data->merkId=$req->merkId;
        $data->name=$req->name;
        $data->save();

        return redirect()->route('product')->with('success', 'Data berhasil diubah!');
    }

    public function delete(Request $req){
        $data = Product::find($req->id);
        $data->delete();
    }
}
