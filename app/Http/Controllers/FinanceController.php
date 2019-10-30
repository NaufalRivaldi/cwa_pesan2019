<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Finance;

use File;

class FinanceController extends Controller
{
    public function index(){
        $menu = 5;
        $dep = auth()->user()->dep;
        $no = 1;
        $finance = Finance::groupBy('nama')->orderBy('nama', 'desc')->get();
        return view('admin.finance.index', compact('dep', 'finance', 'no', 'menu'));
    }

    public function save(Request $req){
        $this->val($req);

        if($req->hasfile('file')){
            $file = $req->file;
            $ext = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            $row = explode('.', $name);
            
            // cek file
            $old = Finance::where('file_name', '=', $name)->first();
            if(!empty($old)){
                File::delete('file-finance'.$old->file_name);
            }else{
                // save database
                Finance::insert([
                    'tgl' => date('Y-m-d H:i:s'),
                    'nama' => $row[0],
                    'file_name' => $name,
                    'user_id' => auth()->user()->id
                ]);
            }

            // upload
            $file->move(public_path().'/file-finance/', $name);
        }

        return redirect('/admin/finance')->with('success', 'Data berhasil di upload');
    }

    public function detail($nama){
        $menu = 5;
        $dep = auth()->user()->dep;
        $no = 1;
        $finance = Finance::where('nama', '=', $nama)->get();
        return view('admin.finance.detail', compact('dep', 'no', 'finance', 'menu'));
    }

    public function val($req){
        $message = [
            'required' => ':attribute tidak boleh kosong!',
            'mimes' => 'Format :attribute salah.'
        ];
        $this->validate($req, [
            'file' => 'required'
        ], $message);
    }
}
