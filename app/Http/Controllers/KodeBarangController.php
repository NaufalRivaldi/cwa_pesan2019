<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use App\Imports\KodeBarangImport;
use App\KodeBarang;

class KodeBarangController extends Controller
{
    public function index(){
        $no = 1;
        $data['title'] = 'Kode Barang';
        $data['kodebarang'] = KodeBarang::all();

        return view('backend.kodebar.index', compact('no', 'data'));
    }

    public function save(Request $req){
        $this->val($req);
        KodeBarang::truncate();

        $file = $req->file('file');
        $nama_file = $file->getClientOriginalName();
        $file->move(public_path().'/Ukodebarang/', $nama_file);

        // import data
        Excel::import(new KodeBarangImport, public_path().'/Ukodebarang/'.$nama_file);
        
        return redirect('backend/kodebarang')->with('status', 'import-success');
    }

    public function val($req){
        $this->validate($req, [
            "file" => "required|max:2000|mimes:xlsx"
        ]);
    }
}
