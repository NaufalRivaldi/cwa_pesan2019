<?php

namespace App\Http\Controllers\Mixing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mixing\Product;
use App\Mixing\Merk;
use App\Mixing\Base;

class ProductController extends Controller
{
    public function index(){
        $data['menu'] = '11';
        $data['products'] = Product::all();
        $data['no'] = 1;
        return view('admin.mixing.product.index', $data);
    }

    public function form(){
        $data['menu'] = '11';
        $data['merks'] = Merk::orderBy('name', 'ASC')->get();
        return view('admin.mixing.product.form', $data);
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

        return redirect()->route('mixing.product')->with('success', 'Data berhasil ditambah!');
    }

    public function edit(){
        $data['menu'] = '11';
        $id = $_GET['id'];
        $data['product'] = Product::find($id);
        $data['merks'] = Merk::orderBy('name', 'ASC')->get();
        return view('admin.mixing.product.form', $data);
    }

    public function update(Request $req){
        $this->val($req);
        $data = Product::find($req->id);
        $data->merkId=$req->merkId;
        $data->name=$req->name;
        $data->save();

        return redirect()->route('mixing.product')->with('success', 'Data berhasil diubah!');
    }

    public function delete(Request $req){
        $data = Product::find($req->id);
        $data->delete();
    }

    public function showBase(){
        $id = $_GET['id'];
        $data['no'] = 1;
        $data['base'] = Base::where('productId', $id)->get();

        return view('admin.mixing.product.tableBase', $data);
    }
}
