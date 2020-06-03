<?php

namespace App\Http\Controllers\Prosedur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Prosedur;
use App\Departemen;
use App\KaryawanAll;

class ProsedurGlobalController extends Controller
{
    public function index()
    {
        $data['menu'] = '14';
        $data['no'] = '1';
        // session()->forget(['nik']);
        if (session('nik')) {           
            $data['prosedur'] = Prosedur::orderBy('id', 'desc')->get();
        } else {
            $data['prosedur'] = Prosedur::whereHas('departemen', function($query){
                $query->where('nama', auth()->user()->dep);
            })->orderBy('id', 'desc')->get();
        }
        
        return view('admin.prosedur.index', $data);
    }

    public function login(Request $request)
    {        
        $data['menu'] = '14';
        $data['no'] = '1';
        $karyawan = KaryawanAll::where('dep', auth()->user()->dep)->where('nik', $request->nik)->where('password', sha1($request->password))->where('stat', 2)->where('ket', 1)->first();
        if (!empty($karyawan)) {
            session(['nik'=>$request->nik]);
        } else {
            return redirect()->route('prosedur.index')->with('error', 'NIK/Password salah!');
        }

        return redirect()->route('prosedur.index')->with('success', 'Berhasil login!');
    }

    public function view($id)
    {
        $data['menu'] = '14';
        $data['prosedur'] = Prosedur::find($id);

        return view('admin.prosedur.view', $data);
    }
}
