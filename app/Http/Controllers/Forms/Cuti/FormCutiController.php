<?php

namespace App\Http\Controllers\Forms\Cuti;

use Illuminate\Http\Request;
use App\Http\Requests\Form\HRD\FormCutiRequest;
use App\Http\Controllers\Controller;

use App\Forms\formcuti\Cuti;
use App\Forms\formcuti\FormCuti;
use App\Forms\formcuti\DetailFormCuti;
use Auth;
use App\Helpers\helper;
use App\KaryawanAll;
use App\Forms\formcuti\VerifikasiFormCuti;

class FormCutiController extends Controller
{
    public function index()
    {
        $data['menu'] = '8';
        $data['no'] = '1';
        $data['indexDone'] = '1';

        $data['formProgress'] = FormCuti::whereHas('karyawan', function($query){
            $query->where('dep', auth()->user()->dep);
        })->where('status', '<', 4)->orderBy('id', 'desc')->get();

        $data['formDone'] = FormCuti::whereHas('karyawan', function($query){
            $query->where('dep', auth()->user()->dep);
        })->where('status', '>', 3)->orderBy('id', 'desc')->get();

        return view('admin.form.hrd.formcuti.index', $data);
    }

    public function form()
    {
        $data['menu'] = '8';
        $data['cuti'] = Cuti::where('status', 1)->whereHas('karyawan', function($query){
            $query->where('dep', Auth::user()->dep);
        })->groupBy('idKaryawan')->get();
        
        return view('admin.form.hrd.formcuti.form', $data);
    }

    public function kategori()
    {
        $karyawanId = $_GET['id'];
        $kategori = Cuti::where('idKaryawan', $karyawanId)->get();
        $text = '<option value="">Pilih Kategori...</option>';
        foreach ($kategori as $k) {
            $text .= '<option value="'.$k->id.'">'.$k->kategoriCuti->kategori.'</option>';
        }
        return $text;
    }

    public function maxCuti()
    {
        $idCuti = $_GET['id'];
        $maxCuti = Cuti::where('id', $idCuti)->first();
        $sisaCuti = $maxCuti->sisaCuti;
        $batasCuti = date('n')+1;

        if ($sisaCuti >= $batasCuti) {
            return $batasCuti;
        } else {
            return $sisaCuti;
        }
    }

    public function add(FormCutiRequest $req)
    {         
        $karyawan = KaryawanAll::where('id', $req->karyawanId)->where('stat', '=' , 1)->first();

        if (!empty($karyawan)) {
            $status = 1;
        } else {
            $status = 2;
        }

        FormCuti::create([
            'karyawanId'=>$req->karyawanId,
            'userId'=>Auth::user()->id,
            'status'=>$status
        ]);

        $formCuti = FormCuti::orderBy('id', 'desc')->first();

        for ($i=0; $i < count($req->tanggalCuti); $i++) {
            DetailFormCuti::create([
                'idFormCuti'=>$formCuti->id,
                'idCuti'=>$req->idCuti,
                'tanggalCuti'=>$req->tanggalCuti[$i],
                'keterangan'=>$req->keterangan[$i]
            ]);
        }

        return redirect()->route('form.hrd.cuti.formcuti')->with('success', 'Data berhasil ditambah!');
    }

    public function detail()
    {
        $id = $_GET['id'];
        
        $formCuti = FormCuti::find($id);
        $verifikasi = VerifikasiFormCuti::where('idFormCuti', $id)->orderBy('id', 'desc')->first();
        if (empty($verifikasi)) {
            $keterangan = '-';
        } else {
            $keterangan = $verifikasi->keterangan;
        }

        $arr = [
            'tglPengajuan'=>helper::setDate($formCuti->created_at),
            'namaKaryawan'=>$formCuti->karyawan->nama,
            'departemen'=>$formCuti->karyawan->dep,
            'status'=>$formCuti->status,
            'stat'=>helper::statusFormCuti($formCuti->status),
            'id'=>$formCuti->id,
            'keterangan'=>$keterangan
        ];

        return $arr;
    }

    public function detailCuti()
    {
        $id = $_GET['id'];
        $data['no'] = 1;
        $data['detailFormCuti'] = DetailFormCuti::where('idFormCuti', $id)->get();

        return view('admin.form.hrd.formcuti.tableCuti', $data);
    }

    public function verifikasi(Request $req)
    {
        $nik = $req->nik;
        $password = sha1($req->password);

        $karyawan = KaryawanAll::where('stat', 2)->where('nik', $nik)->where('password', $password)->where('dep' , auth()->user()->dep)->first();

        if (!empty($karyawan)) {
            $form = FormCuti::find($req->id);
            switch ($req->type) {
                case '1':
                    $form->status = 2;
                    $form->save();
                    $this->validasiVerifikasi($req, $karyawan->id);
                    break;
                
                default:
                    $form->status = 5;
                    $form->save();
                    $this->validasiVerifikasi($req, $karyawan->id);
                    break;
            }

            return redirect()->route('form.hrd.cuti.formcuti')->with('success', 'Form telah diverifikasi!');
        } 

        return redirect()->route('form.hrd.cuti.formcuti')->with('error', 'Form gagal diverifikasi!');
    }

    public function validasiVerifikasi($req, $karyawanId)
    {
        if (empty($req->keterangan)) {
            $keterangan = '-';
        }else{
            $keterangan = $req->keterangan;
        }
        VerifikasiFormCuti::create([
            'userId'=>Auth::user()->id,
            'karyawanId'=>$karyawanId,
            'status'=>'1',
            'keterangan'=>$keterangan,
            'idFormCuti'=>$req->id
        ]);
    }

    public function delete(Request $req)
    {
        $data = FormCuti::find($req->id);
        $data->delete();
    }
}
