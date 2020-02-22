<?php

namespace App\Http\Controllers\Mixing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;

use App\Mixing\Base;
use App\Mixing\Product;

class BaseController extends Controller
{
    public function form($id){
        $data['menu'] = 13;
        $data['product'] = Product::find($id);
        
        return view('admin.mixing.base.form', $data);
    }

    public function edit(){
        $id = $_GET['id'];
        $data['menu'] = 13;
        $data['base'] = Base::find($id);
        
        return view('admin.mixing.base.form', $data);
    }

    public function add(BaseRequest $req){
        for($i = 0; $i < count($req->name); $i++){
            Base::create([
                'productId' => $req->productId,
                'name' => $req->name[$i]
            ]);
        }

        return redirect()->route('mixing.product')->with('success', 'Tambah base berhasil.');
    }

    public function update(Request $req){
        $data = Base::find($req->id);
        $data->name = $req->name;
        $data->save();

        return redirect()->route('mixing.product')->with('success', 'Edit Base Berhasil');
    }

    public function delete(Request $req){
        $data = Base::find($req->id);
        $data->delete();
    }
}
