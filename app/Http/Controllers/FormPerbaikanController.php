<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormPerbaikanRequest;
use App\Helpers\helper;

use App\FormPerbaikanSarana;
use App\KaryawanAll;

use Auth;

class FormPerbaikanController extends Controller
{
    public function index(){
        $data['menu'] = 8;

        if(auth()->user()->dep == 'IT' || auth()->user()->dep == 'GA' || auth()->user()->dep == 'Accounting'){
            $data['formProgress'] = FormPerbaikanSarana::where('status', '<', '4')->orderBy('created_at', 'desc')->get();

            $data['formSelesai'] = FormPerbaikanSarana::where('status', '>', '3')->orderBy('created_at', 'desc')->get();
        }else{
            $data['formProgress'] = FormPerbaikanSarana::where('userId', auth()->user()->id)->where('status', '<', '4')->orderBy('created_at', 'desc')->get();

            $data['formSelesai'] = FormPerbaikanSarana::where('userId', auth()->user()->id)->where('status', '>', '3')->orderBy('created_at', 'desc')->get();
        }
        
        return view('admin.form.ga.perbaikan.index', $data);
    }

    public function form(){
        $data['menu'] = 8;
        $data['dateNow'] = date('Y-m-d');
        $data['kodeForm'] = $this->kodeForm();

        return view('admin.form.ga.perbaikan.form', $data);
    }    

    public function kodeForm()
    {
        $y = date('y');
        $m = date('m');
        $kode = 'FGB';
        $form = FormPerbaikanSarana::where('created_at','LIKE','%'.$y."-".$m.'%')->orderBy('id', 'desc')->first();
        if(empty($form)){
            $kode .= $y.$m.'001';
        } else {
            $row = explode($y.$m, $form->kode);
            $kode .= $y.$m.$row[1]+1;
        }
        return $kode;
    }

    public function view(){
        $id = $_GET['id'];
        $data = FormPerbaikanSarana::find($id);
        $array = [
            "kodeForm" => $data->kode,
            "tglPengajuan" => helper::setDate($data->tglPengajuan),
            "tglSelesai" => helper::setDate($data->tglSelesai),
            "pengaju" => $data->user->nama,
            "status" => helper::statusPerbaikan($data->status),
            "permintaan" => $data->permintaan,
            "alasan" => $data->alasan,
            "keterangan" => $data->keterangan
        ];

        return $array;
    }

    public function store(FormPerbaikanRequest $req){
        FormPerbaikanSarana::create([
            'kode' => $req->kode,            
            'tglPengajuan' => $req->tglPengajuan,
            'tglSelesai' => $req->tglPengajuan,
            'permintaan' => $req->permintaan,
            'alasan' => $req->alasan,
            'status' => 1,
            'keterangan' => '-',
            'userId' => Auth()->user()->id
        ]);

        // notif
        helper::notifikasiFormGlobal('admin/form/ga/perbaikan-sarana', Auth::user()->nama, 'GA', 'Anda telah menerima Form Perbaikan dari');

        return redirect()->route('form.ga.perbaikan')->with('success', 'Form telah diajukan.');
    }

    public function validasi(Request $req){
        $this->validation($req);
        $nik = $req->nik;
        $password = sha1($req->password);

        $karyawan = KaryawanAll::where('nik', $nik)->where('password', $password)->where('dep', 'GA')->first();

        if(!empty($karyawan)){
            $form = FormPerbaikanSarana::find($req->id);
            switch ($req->type) {
                case '1':
                    $form->status = 2;
                    $form->save();
                    break;
                
                default:
                    $form->status = 5;
                    $form->keterangan = $req->keterangan;
                    $form->save();
                    break;
            }

            return redirect()->route('form.ga.perbaikan')->with('success', 'Form telah di verifikasi');
        }

        return redirect()->route('form.ga.perbaikan')->with('error', 'Form gagal di verifikasi');
    }

    public function updateStatus(Request $req){
        $keterangan = '-';
        $form = FormPerbaikanSarana::find($req->id);
        $form->status = $req->stat;

        if($req->keterangan != null){
            $keterangan = $req->keterangan;
        }

        $form->keterangan = $keterangan;

        if($req->stat == '4'){
            $form->tglSelesai = $req->tglSelesai;
        }

        $form->save();

        return redirect()->route('form.ga.perbaikan')->with('success', 'Form telah di update');
    }

    public function delete(Request $req){
        $data = FormPerbaikanSarana::find($req->id);
        $data->delete();
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
