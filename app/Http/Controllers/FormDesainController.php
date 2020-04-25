<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\JenisDesain;
use App\FormPengajuanDesain;
use App\Helpers\helper;
use App\KaryawanAll;

class FormDesainController extends Controller
{
    public function index(){
        $data['menu'] = 8;
        $data['no'] = 1;
        
        if(auth()->user()->dep == 'IT' || auth()->user()->dep == 'Accounting'){
            $data['form_proses'] = FormPengajuanDesain::where('stat', '<', 4)->orderBy('created_at', 'desc')->get();
            $data['form_done'] = FormPengajuanDesain::where('stat', '>', 3)->orderBy('created_at', 'desc')->get();
        }else{
            $data['form_proses'] = FormPengajuanDesain::whereHas('user', function($query){
                $query->whereDep(auth()->user()->dep);
            })->where('stat', '<', 4)->orderBy('created_at', 'desc')->get();
            $data['form_done'] = FormPengajuanDesain::whereHas('user', function($query){
                $query->whereDep(auth()->user()->dep);
            })->where('stat', '>', 3)->orderBy('created_at', 'desc')->get();
        }

        return view('admin.form.desain.index', $data);
    }

    public function form(){
        $tglPengerjaan = '';
        $data['menu'] = 8;
        $data['jenis_desain'] = JenisDesain::all();
        $data['karyawan'] = KaryawanAll::where('dep', auth()->user()->dep)->where('ket', '1')->get();
        $data['kode'] = $this->generateKode();
        $date = explode('-',date('Y-m-D'));
        if ($date[2] == 'Sun' || $date[2] == 'Mon' || $date[2] == 'Tue' || $date[2] == 'Wed') {
            $tglPengerjaan = date('Y-m-d', strtotime('+3 day', strtotime(date('Y-m-d'))));
        } else {
            $tglPengerjaan = date('Y-m-d', strtotime('+4 day', strtotime(date('Y-m-d'))));
        }
        $data['tglPengerjaan'] = $tglPengerjaan;
        return view('admin.form.desain.form', $data);
    }

    public function view(){
        $id = $_GET['id'];
        $data = FormPengajuanDesain::find($id);
        $array = [
            "kode" => $data->kode,
            "status" => helper::statusDesain($data->stat),
            "jenisDesain" => $data->jenisDesain->nama,
            "tglPengajuan" => date('Y-m-d', strtotime($data->created_at)),
            "tglDiperlukan" => $data->tgl_perlu,
            "qty" => $data->qty,
            "ukuranCetak" => $data->ukuran,
            "deskripsi" => $data->deskripsi,
            "keterangan_lain" => $data->keterangan_lain,
            "karyawan_all" => $data->karyawanAll->nama.' - '.$data->karyawanAll->dep
        ];

        return $array;
    }

    public function store(Request $req){
        $this->val($req);
        $keteranganLain = '-';
        if(!empty($req->keterangan_lain)){
            $keteranganLain = $req->keterangan_lain;
        }
        
        FormPengajuanDesain::create([
            "kode" => $req->kode,
            "tgl_perlu" => $req->tgl_perlu,
            "qty" => $req->qty,
            "ukuran" => $req->ukuran,
            "deskripsi" => $req->deskripsi,
            "stat" => 1,
            "keterangan" => "-",
            "keterangan_lain" => $keteranganLain,
            "jenis_desain_id" => $req->jenis_desain_id,
            "karyawan_all_id" => $req->karyawan_all_id,
            "user_id" => auth()->user()->id
        ]);

        helper::notifikasiFormDesain(auth()->user()->nama);

        return redirect()->route('desainIklan')->with('success', 'Form Berhasil Diajukkan.');
    }

    public function validasi(Request $req){
        $this->validation($req);
        $nik = $req->nik;
        $password = sha1($req->password);

        $karyawan = KaryawanAll::where('nik', $nik)->where('password', $password)->where('dep', 'IT')->where('stat', 2)->first();

        if(!empty($karyawan)){
            $form = FormPengajuanDesain::find($req->id);
            switch ($req->type) {
                case '1':
                    $form->stat = 2;
                    $form->save();
                    break;
                
                default:
                    $form->stat = 5;
                    $form->keterangan = "IT : ".$req->keterangan;
                    $form->save();
                    break;
            }

            return redirect()->route('desainIklan')->with('success', 'Form telah di verifikasi');
        }

        return redirect()->route('desainIklan')->with('error', 'Form gagal di verifikasi');
    }

    public function updateStatus(Request $req){
        $form = FormPengajuanDesain::find($req->id);
        $form->stat = $req->stat;
        $form->save();

        return redirect()->route('desainIklan')->with('success', 'Form telah di update');
    }

    public function delete($id){
        $form = FormPengajuanDesain::find($id);
        $form->delete();

        return redirect()->route('desainIklan')->with('success', 'Form telah di delete');
    }

    public function val($req){
        $message = [
            'required' => 'Tidak boleh kosong!',
            'numeric' => 'Kolom ini harus berupa angka'
        ];

        $this->validate($req, [
            'karyawan_all_id' => 'required',
            'jenis_desain_id' => 'required',
            'tgl_perlu' => 'required|date',
            'qty' => 'numeric|required',
            'ukuran' => 'required'
        ], $message);
    }

    public function validation($req){
        $message = [
            'required' => 'Tidak boleh kosong!'
        ];

        $this->validate($req, [
            'nik' => 'required',
            'password' => 'required',
        ], $message);
    }

    public function generateKode(){
        $kode = 'FID';
        $date = date('Y-m');
        $data = FormPengajuanDesain::where('created_at', 'like', '%'.$date.'%')->orderBy('id', 'desc')->first();

        if(empty($data)){
            $kode .= date('ym').'001';
        }else{
            $row = explode(date('ym'), $data->kode);
            $kode .= date('ym').$row[1]+1;
        }

        return $kode;
    }
}
