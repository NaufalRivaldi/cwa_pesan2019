<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormPeminjamanRequest;
use App\Http\Requests\Form\GA\PeminjamanSarana\UpdateSarana;

use App\FormPeminjamanSarana;
use App\DetailFormPeminjamanSarana;
use App\Sarana;
use App\KaryawanAll;

use App\Helpers\helper;

use Auth;

class FormPeminjamanController extends Controller
{
    public function index(){
        $data['menu'] = 8;
        $data['no'] = 1;
        $data['sarana'] = Sarana::all();
        
        if(auth()->user()->dep == 'IT' || auth()->user()->dep == 'GA' || auth()->user()->dep == 'Accounting'){
            $data['formProgress'] = FormPeminjamanSarana::where('status', '<', '2')->orderBy('created_at', 'desc')->get();

            $data['formSelesai'] = FormPeminjamanSarana::where('status', '>', '1')->orderBy('created_at', 'desc')->get();
        }else{
            $data['formProgress'] = FormPeminjamanSarana::where('userId', auth()->user()->id)->where('status', '<', '2')->orderBy('created_at', 'desc')->get();

            $data['formSelesai'] = FormPeminjamanSarana::where('userId', auth()->user()->id)->where('status', '>', '1')->orderBy('created_at', 'desc')->get();
        }

        return view('admin.form.ga.peminjaman.index', $data);
    }

    public function form(){
        $data['menu'] = 8;
        $data['dateNow'] = date('Y-m-d');
        $data['sarana'] = Sarana::all();
    
        return view('admin.form.ga.peminjaman.form', $data);
    }

    public function store(FormPeminjamanRequest $req){
        FormPeminjamanSarana::create([
            'status' => '1',
            'userId' => auth()->user()->id
        ]);

        $form = FormPeminjamanSarana::orderBy('id', 'desc')->first();

        for($i = 0; $i < count($req->saranaId); $i++){
            DetailFormPeminjamanSarana::create([
                'tgl' => $req->tglPengajuan[$i],
                'keterangan' => $req->keterangan[$i],
                'pukulA' => $req->pukulA[$i],
                'pukulB' => $req->pukulB[$i],
                'formPeminjamanId' => $form->id,
                'saranaId' => $req->saranaId[$i]
            ]);
        }

        // notif
        helper::notifikasiFormPeminjaman(Auth::user()->nama);

        return redirect()->route('form.ga.peminjaman')->with('success', 'Form Sudah diajukan.');
    }

    public function view(){
        $id = $_GET['id'];
        $data = FormPeminjamanSarana::find($id);
        $array = [
            "tglPengajuan" => helper::setDate($data->created_at),
            "pengaju" => $data->user->nama.' ('.$data->user->dep.')',
            "status" => helper::statusPeminjaman($data->status),
            "keterangan" => $data->keterangan
        ];

        return $array;
    }

    public function editSarana(){
        $id = $_GET['id'];
        $data = DetailFormPeminjamanSarana::find($id);
        $array = [
            "id" => $data->id,
            "tgl" => $data->tgl,
            "keterangan" => $data->keterangan,
            "pukulA" => $data->pukulA,
            "pukulB" => $data->pukulB,
            "formPeminjamanId" => $data->formPeminjamanId,
            "saranaId" => $data->saranaId,
            "namaSarana" => $data->sarana->namaSarana
        ];

        return $array;
    }

    public function updateSarana(UpdateSarana $req){
        $data = DetailFormPeminjamanSarana::find($req->id);
        $data->tgl = $req->tgl;
        $data->pukulA = $req->pukulA;
        $data->pukulB = $req->pukulB;
        $data->saranaId = $req->saranaId;
        $data->keterangan = $req->keterangan;
        $data->save();

        return redirect()->route('form.ga.peminjaman')->with('success', 'Data Berhasil diupdate.');
    }

    public function validasi(Request $req){
        $this->validation($req);
        $nik = $req->nik;
        $password = sha1($req->password);

        $karyawan = KaryawanAll::where('stat', 2)->where('nik', $nik)->where('password', $password)->where('dep', 'GA')->first();

        if(!empty($karyawan)){
            $form = FormPeminjamanSarana::find($req->id);
            switch ($req->type) {
                case '1':
                    $form->status = 2;
                    $form->save();
                    break;
                
                default:
                    $form->status = 3;
                    $form->keterangan = $req->keterangan;
                    $form->save();
                    break;
            }

            helper::notifikasiAccPeminjaman($form->id);

            return redirect()->route('form.ga.peminjaman')->with('success', 'Form telah di verifikasi');
        }

        return redirect()->route('form.ga.peminjaman')->with('error', 'Form gagal di verifikasi');
    }

    public function table(){
        $id = $_GET['id'];
        $data['no'] = 1;
        $data['formPeminjaman'] = FormPeminjamanSarana::find($id);
        $data['peminjaman'] = DetailFormPeminjamanSarana::where('formPeminjamanId', $id)->get();

        return view('admin.form.ga.peminjaman.table', $data);
    }

    public function delete(Request $req){
        $data = FormPeminjamanSarana::find($req->id);
        $data->delete();
    }

    public function deleteSarana(Request $req){
        $data = DetailFormPeminjamanSarana::find($req->id);
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
