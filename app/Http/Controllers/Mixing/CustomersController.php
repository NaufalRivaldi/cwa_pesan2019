<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;
use App\Mixing;

class CustomersController extends Controller
{
    public function index(){
        $data['customers'] = Customers::all();
        $data['no'] = 1;
        return view('customers.index', $data);
    }

    public function form(){
        return view('customers.form');
    }

    public function view($id){
        $data['no'] = 1;
        $data['customer'] = Customers::find($id);
        $data['mixing'] = Mixing::where('customersId', $id)->orderBy('created_at', 'desc')->get();

        return view('customers.view', $data);
    }

    public function val($req){
        $msg = [
            'required' => 'Kolom ini tidak boleh kosong!'
        ];

        $this->validate($req, [
            'name' => 'required',
            'phone' => 'required'
        ], $msg);
    }

    public function add(Request $req){
        $this->val($req);
        Customers::create([
            'name'=>$req->name,
            'phone'=>$req->phone,
            'memberId'=>$req->memberId
        ]);

        return redirect()->route('customers')->with('success', 'Data berhasil ditambah!');
    }

    public function edit(){
        $id = $_GET['id'];
        $data['customer'] = Customers::find($id);
        return view('customers.form', $data);
    }

    public function update(Request $req){
        $this->val($req);
        $data = Customers::find($req->id);
        $data->name=$req->name;
        $data->phone=$req->phone;
        $data->memberId=$req->memberId;
        $data->save();

        return redirect()->route('customers')->with('success', 'Data berhasil diubah!');
    }

    public function delete(Request $req){
        $data = Customers::find($req->id);
        $data->delete();
    }


}
