<?php

namespace App\Http\Controllers\Mixing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mixing\Mixing;
use App\Mixing\Product;
use App\Mixing\Customers;
use App\Mixing\Merk;
use App\Mixing\Formula;
use App\Mixing\DetailFormula;
use App\Mixing\Base;

class MixingController extends Controller
{
    public function index(){
        $data['menu'] = '11';
        $data['no'] = 1;
        if (auth()->user()->dep == 'IT') {
            $data['mixings'] = Mixing::orderBy('created_at', 'DESC')->get();
        } else {
            $data['mixings'] = Mixing::whereHas('user', function($query){
                $query->where('dep', auth()->user()->dep);
            })->orderBy('created_at', 'DESC')->get();
        }
        return view('admin.mixing.mixing.index', $data);
    }

    public function form(){
        $data['menu'] = '11';
        $data['no'] = 1;
        $data['products'] = Product::orderBy('merkId', 'ASC')->get();
        $data['customers'] = Customers::orderBy('name', 'ASC')->get();
        $data['merks'] = Merk::orderBy('name')->get();
        return view('admin.mixing.mixing.form', $data);
    }

    public function reorder($id){
        $data['menu'] = '11';
        $data['no'] = 1;
        $mixing = Mixing::find($id);
        $data['mixing'] = $mixing;
        $data['products'] = Product::where('merkId', $mixing->product->merk->id)->get();
        $data['base'] = Base::where('productId', $mixing->base->product->id)->get();
        $data['customers'] = Customers::orderBy('name', 'ASC')->get();
        $data['customer'] = Customers::find($mixing->customersId);
        $data['merks'] = Merk::orderBy('name')->get();
        $data['formula'] = DetailFormula::where('mixingId', $id)->get();
        return view('admin.mixing.mixing.reorder', $data);
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

    public function showBase(){
        $fill = "<option value=''>Pilih</option>";
        $id = $_GET['id'];
        $data = Base::where('productId', $id)->orderBy('name')->get();
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
            <label for="exampleFormControlSelect3" style="font-size:0.7em">'.$data->color.'</label>
                <div class="form-group">                    
                    <input type="checkbox" class="form-check-input mt-2 select" value="" data-id="'.$data->id.'" data-class="cb'.$data->id.'" onclick="ifChecked(this)">
                    <input type="hidden" class="form-control" name="formulaId[]" value="'.$data->id.'">
                    <input type="text" class="form-control form-control-sm cb'.$data->id.'" name="nilai[]" id="inputBox
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
            'base'=>$data->base->name,
            'qty'=>$data->qty,
            'unit'=>$data->unit,
            'colorCode'=>$data->colorCode,
            'colorName'=>$data->colorName,
            'createDate'=>$data->tglMixing,
            'storeName'=>$data->user->dep,
            'storeInitial'=>$data->user->dep,
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
            'tglMixing' => 'required',
            'productId' => 'required',
            'baseId' => 'required',
            'qty' => 'required|numeric',
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
            'tglMixing'=>$req->tglMixing,
            'baseId'=>$req->baseId,
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

        return redirect()->route('mixing.mixing')->with('success', 'Data berhasil ditambah!');
    }

    public function delete(Request $req){
        $data = Mixing::find($req->id);
        $data->delete();
    }
}
