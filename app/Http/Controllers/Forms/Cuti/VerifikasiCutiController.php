<?php

namespace App\Http\Controllers\Forms\Cuti;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forms\formcuti\FormCuti;
use App\KaryawanAll;
use App\Forms\formcuti\VerifikasiFormCuti;
use App\Forms\formcuti\DetailFormCuti;
use App\Forms\formcuti\Cuti;

class VerifikasiCutiController extends Controller
{
    public function index()
    {
        $data['menu'] = '8';
        $data['no'] = 1;

        $data['formCuti'] = FormCuti::where('status', 2)->orderBy('id', 'desc')->get();

        $data['formCutiOffice'] = FormCuti::where('status', 3)->orderBy('id', 'desc')->get();

        return view('admin.form.hrd.formcuti.verifikasi.index', $data);
    }
    
    public function verifikasiHRD(Request $req)
    {
        $nik = $req->nik;
        $password = sha1($req->password);

        $hrd = KaryawanAll::where('dep', 'HRD')->where('nik', $nik)->where('password', $password)->first();

        if (!empty($hrd)) {
            $form = FormCuti::find($req->id);           
            $detailFormCuti = DetailFormCuti::where('idFormCuti', $req->id)->first();
            $cuti = Cuti::find($detailFormCuti->idCuti);
            switch ($req->type) {
                case '1':
                    if ($form->karyawan->stat == '5') {
                        $form->status = 4;
                        // $cuti->sisaCuti = ($cuti->sisaCuti - $jumlahCuti);
                        if ($cuti->sisaCuti == 0) {
                            $cuti->status = 2;
                        }
                    } else {
                        $form->status = 3;
                    }
                    $form->save();
                    $cuti->save();
                    $this->validasiVerifikasi($req, $hrd->id);
                    break;
                
                default:                
                    $cuti->sisaCuti = $cuti->sisaCuti + $form->detailCuti->count();
                    $cuti->save();
                    $form->status = 5;
                    $form->save();
                    $this->validasiVerifikasi($req, $hrd->id);
                    break;
            }
            
            return redirect()->route('form.hrd.cuti.verifikasiCuti')->with('success', 'Form telah diverifikasi!');
        }

        return redirect()->route('form.hrd.cuti.verifikasiCuti')->with('error', 'Form gagal diverifikasi!');
    }

    public function verifikasiAM(Request $req)
    {
        $nik = $req->nik;
        $password = sha1($req->password);

        $am = KaryawanAll::where('stat', '5')->where('nik', $nik)->where('password', $password)->first();
        if (!empty($am)) {
            $form = FormCuti::find($req->id);
            $detailFormCuti = DetailFormCuti::where('idFormCuti', $req->id)->first();
            $cuti = Cuti::find($detailFormCuti->idCuti);
            // $idCuti = DetailFormCuti::where('idFormCuti', $req->id)->first();
            // $cuti = Cuti::where('id', $idCuti->idCuti)->first();
            // dd($cuti->sisaCuti - $jumlahCuti);
            switch ($req->type) {
                case '1':
                    $form->status = 4;
                    if ($cuti->sisaCuti == 0) {
                        $cuti->status = 2;
                    }
                    $cuti->save();
                    $form->save();
                    $this->validasiVerifikasi($req, $am->id);
                    break;
                
                default:                
                    $cuti->sisaCuti = $cuti->sisaCuti + $form->detailCuti->count();
                    $cuti->save();
                    $form->status = 5;
                    $form->save();
                    $this->validasiVerifikasi($req, $am->id);
                    break;
            }
            
            return redirect()->route('form.hrd.cuti.verifikasiCuti')->with('success', 'Form telah diverifikasi!');
        }

        return redirect()->route('form.hrd.cuti.verifikasiCuti')->with('error', 'Form gagal diverifikasi!');
    }

    public function validasiVerifikasi($req, $karyawanId)
    {
        if (empty($req->keterangan)) {
            $keterangan = '-';
        } else {
            $keterangan = $req->keterangan;
        }

        VerifikasiFormCuti::create([
            'userId'=>auth()->user()->id,
            'karyawanId'=>$karyawanId,
            'status'=>'1',
            'keterangan'=>$keterangan,
            'idFormCuti'=>$req->id
        ]);

    }
}
