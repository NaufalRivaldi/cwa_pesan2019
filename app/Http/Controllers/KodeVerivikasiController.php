<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\KaryawanAll;

class KodeVerivikasiController extends Controller
{
    public function index(){
        $data['menu'] = 7;
        return view('admin.verivikasi.index', $data);
    }

    public function change(Request $req){
        $this->val($req);

        if(auth()->user()->dep == 'HRD'){
            $karyawan = KaryawanAll::where('stat', '2')->where('dep', auth()->user()->dep)->where('nik', $req->nik)->where('password', sha1($req->oldpassword))->first();
        }else{
            $karyawan = KaryawanAll::where('stat', auth()->user()->level)->where('dep', auth()->user()->dep)->where('nik', $req->nik)->where('password', sha1($req->oldpassword))->first();
        }

        if(!empty($karyawan)){
            $karyawan->password = sha1($req->password);
            $karyawan->save();
        }else{
            return redirect('admin/kodeverifikasi/')->with('error', 'NIK dan Password lama tidak valid!');
        }

        return redirect('admin/kodeverifikasi/')->with('success', 'Password berhasil di ubah');
    }

    public function val($req){
        $massage = [
            "required" => "Password tidak boleh kosong!",
            "same" => "Password baru dan konfirmasi password harus sama!"
        ];

        $this->validate($req, [
            'nik' => 'required',
            'oldpassword' => 'required',
            'password' => 'required',
            'password2' => 'required|same:password'
        ], $massage);
    }
}
