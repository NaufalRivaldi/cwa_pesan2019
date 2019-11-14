<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\FormPenangananIt;
use App\Cabang;
use App\KaryawanAll;
use App\User;

class FormPenangananController extends Controller
{
    public function index(){
        $data['menu'] = '8';
        $data['form'] = FormPenangananIt::orderBy('tgl', 'desc')->get();
        $data['cabang'] = Cabang::orderBy('inisial', 'asc')->get();
        $data['karyawan'] = KaryawanAll::where('dep', 'IT')->get();
        
        return view('admin.form.it.index', $data);
    }

    public function store(Request $req){
        $this->val($req);

        $user = User::where('dep', $req->cabang)->first();
        
        FormPenangananIt::create([
            'tgl' => date('Y-m-d'),
            'masalah' => $req->masalah,
            'penyelesaian' => $req->penyelesaian,
            'stat' => 1,
            'user_id' => $user->id,
            'karyawan_all_id' => $req->karyawan_all_id
        ]);

        return redirect('')
    }

    public function val($req){
        $message = [
            'required' => 'Form ini tidak boleh kosong!'
        ];

        $this->validate($req, [
            'cabang_id' => 'required',
            'karyawan_all_id' => 'required',
            'masalah' => 'required',
            'penyelesaian' => 'required'
        ], $message);
    }
}
