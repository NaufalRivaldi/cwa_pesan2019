<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use App\Imports\UltahImport;
use App\Ultah;

class UltahController extends Controller
{
    public function index(){
        $no = 1;
        $data['title'] = 'Data Ultah';
        $data['ultah'] = Ultah::all();

        return view('backend.ultah.index', compact('no', 'data'));
    }

    public function save(Request $req){
        $this->val($req);
        Ultah::truncate();

        $file = $req->file('file');
        $nama_file = $file->getClientOriginalName();
        $file->move(public_path().'/Uultah/', $nama_file);

        // import data
        Excel::import(new UltahImport, public_path().'/Uultah/'.$nama_file);
        
        return redirect('backend/ultah')->with('status', 'import-success');
    }

    public function val($req){
        $this->validate($req, [
            "file" => "required|max:2000|mimes:xlsx"
        ]);
    }
}
