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
        $data['form_proses'] = FormPengajuanDesain::where('stat', '<', 4)->orderBy('created_at', 'desc')->get();
        $data['form_done'] = FormPengajuanDesain::where('stat', '>', 3)->orderBy('created_at', 'desc')->get();

        return view('admin.form.desain.index', $data);
    }

    public function form(){
        $data['menu'] = 8;
        $data['jenis_desain'] = JenisDesain::all();
        return view('admin.form.desain.form', $data);
    }

    public function view(){
        $id = $_GET['id'];
        $data = FormPengajuanDesain::find($id);
        $array = [
            "status" => helper::statusDesain($data->stat),
            "jenisDesain" => $data->jenisDesain->nama,
            "tglPengajuan" => date('Y-m-d', strtotime($data->created_at)),
            "tglDiperlukan" => $data->tgl_perlu,
            "qty" => $data->qty,
            "ukuranCetak" => $data->ukuran,
            "deskripsi" => $data->deskripsi,
            "keterangan_lain" => $data->keterangan_lain
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
            "tgl_perlu" => $req->tgl_perlu,
            "qty" => $req->qty,
            "ukuran" => $req->ukuran,
            "deskripsi" => $req->deskripsi,
            "stat" => 1,
            "keterangan" => "-",
            "keterangan_lain" => $keteranganLain,
            "jenis_desain_id" => $req->jenis_desain_id
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

    public function val($req){
        $message = [
            'required' => 'Tidak boleh kosong!'
        ];

        $this->validate($req, [
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
}
