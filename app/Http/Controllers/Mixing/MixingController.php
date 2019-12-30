<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mixing;
use App\Product;
use App\Customers;
use App\Merk;
use App\Formula;
use App\DetailFormula;

class MixingController extends Controller
{
    public function index(){
        $data['no'] = 1;
        if (auth()->user()->roles == 1) {
            $data['mixings'] = Mixing::orderBy('created_at', 'DESC')->get();
        } else {
            $data['mixings'] = Mixing::whereHas('users', function($query){
                $query->where('storeId', auth()->user()->storeId);
            })->orderBy('created_at', 'DESC')->get();
        }
        return view('mixing.index', $data);
    }

    public function form(){
        $data['no'] = 1;
        $data['products'] = Product::orderBy('merkId', 'ASC')->get();
        $data['customers'] = Customers::orderBy('name', 'ASC')->get();
        $data['merks'] = Merk::orderBy('name')->get();
        return view('mixing.form', $data);
    }

    public function reorder($id){
        $data['no'] = 1;
        $mixing = Mixing::find($id);
        $data['mixing'] = $mixing;
        $data['products'] = Product::orderBy('merkId', 'ASC')->get();
        $data['customers'] = Customers::orderBy('name', 'ASC')->get();
        $data['customer'] = Customers::find($mixing->customersId);
        $data['merks'] = Merk::orderBy('name')->get();
        $data['formula'] = DetailFormula::where('mixingId', $id)->get();
        return view('mixing.reorder', $data);
    }

    public function fill(){
        $id = $_GET['id'];
        $data = Customers::find($id);
        // $data = json_encode($data);
        return $data;
    }

    public function showProduct(){
        $fill = "<option value=''>Pilih</option>";
        $id = $_GET['id'];
        $data = Product::where('merkId', $id)->orderBy('name')->get();
        foreach($data as $data){
            $fill .= "<option value='".$data->id."'>".$data->name."</option>";
        }

        return $fill;
    }

    public function showFormula(){
        $fill = '';
        $id = $_GET['id'];
        $data = Formula::where('merkId', $id)->orderBy('color')->get();
        $no = 1;
        foreach($data as $data){
            $fill .= '
            <div class="col-md-3">
            <label for="exampleFormControlSelect3">'.$data->color.'</label>
                <div class="form-group">                    
                    <input type="checkbox" class="form-check-input mt-2 select" value="" data-id="'.$data->id.'" data-class="cb'.$data->id.'" onclick="ifChecked(this)">
                    <input type="hidden" class="form-control" name="formulaId[]" value="'.$data->id.'">
                    <input type="text" class="form-control cb'.$data->id.'" name="nilai[]" id="inputBox
                    " value="0" readonly>               
                </div>
            </div>
            ';
        }

        return $fill;
    }

    public function view(){
        $id = $_GET['id'];
        $text = '';
        $data = Mixing::find($id);
        $formula = DetailFormula::where('mixingId', $id)->get();
        foreach($formula as $formula){
            $text .= $formula->formula->color.' : '.$formula->nilai.', ';
        }
        // $data = json_encode($data);
        $arr = [
            'custName'=>$data->customers->name,
            'custPhone'=>$data->customers->phone,
            'custMemberId'=>$data->customers->memberId,
            'productName'=>$data->product->name,
            'base'=>$data->base,
            'qty'=>$data->qty,
            'unit'=>$data->unit,
            'colorCode'=>$data->colorCode,
            'colorName'=>$data->colorName,
            'createDate'=>date('d F Y', strtotime($data->created_at)),
            'storeName'=>$data->users->store->name,
            'storeInitial'=>$data->users->store->initial,
            'formula' => $text,
            'merk' => $data->product->merk->name
        ];

        return $arr;
    }

    public function val($req){
        $msg = [
            'required' => 'Kolom ini tidak boleh kosong!'
        ];

        $this->validate($req, [
            'customersId' => 'required',
            'productId' => 'required',
            'base' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'colorCode' => 'required',
            'colorName' => 'required'
        ], $msg);
    }

    public function add(Request $req){
        $userId = auth()->user()->id;
        $this->val($req);
        
        Mixing::create([
            'userId'=>$userId,
            'customersId'=>$req->customersId,
            'productId'=>$req->productId,
            'base'=>$req->base,
            'qty'=>$req->qty,
            'unit'=>$req->unit,
            'colorCode'=>$req->colorCode,
            'colorName'=>$req->colorName,
        ]);

        $data = Mixing::orderBy('created_at', 'desc')->first();
        for($i = 0; $i < count($req->formulaId); $i++){
            DetailFormula::create([
                'nilai' => $req->nilai[$i],
                'formulaId' => $req->formulaId[$i],
                'mixingId' => $data->id
            ]);
        }

        return redirect()->route('mixing')->with('success', 'Data berhasil ditambah!');
    }

    public function delete(Request $req){
        $data = Mixing::find($req->id);
        $data->delete();
    }
}
