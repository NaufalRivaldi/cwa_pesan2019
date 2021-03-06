<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\form\IT\PenangananIt\VerifikasiRequest;

use App\Helpers\helper;

use App\FormPenangananIt;
use App\Cabang;
use App\KaryawanAll;
use App\User;
use App\DetailFormPenangananIt;

class FormPenangananController extends Controller
{
    public function index(){
        $data['menu'] = '8';
        $data['no'] = '1';
        
        if(auth()->user()->dep == 'IT'){
            if($_GET){
                $tglA = $_GET['tglA'];
                $tglB = $_GET['tglB'];
                $dep = $_GET['dep'];
                $stat = $_GET['stat'];

                if(empty($tglA) || empty($tglB)){
                    $data['form'] = FormPenangananIt::whereHas('user', function($query) use ($dep){
                        $query->where('dep', 'like', '%'.$dep.'%');
                    })->where('stat', 'like', '%'.$stat.'%')->orderBy('created_at', 'desc')->get();
                }else{
                    $data['form'] = FormPenangananIt::whereBetween('tgl', [$tglA, $tglB])->whereHas('user', function($query) use ($dep){
                        $query->where('dep', 'like', '%'.$dep.'%');
                    })->where('stat', 'like', '%'.$stat.'%')->orderBy('created_at', 'desc')->get();
                }
            }else{
                $data['form'] = FormPenangananIt::orderBy('created_at', 'desc')->get();
            }
        }else{
            if($_GET){
                $tglA = $_GET['tglA'];
                $tglB = $_GET['tglB'];
                $stat = $_GET['stat'];

                if(empty($tglA) || empty($tglB)){
                    $data['form'] = FormPenangananIt::where('user_id', auth()->user()->id)->where('stat', 'like', '%'.$stat.'%')->orderBy('created_at', 'desc')->get();
                }else{
                    $data['form'] = FormPenangananIt::where('user_id', auth()->user()->id)->whereBetween('tgl', [$tglA, $tglB])->where('stat', 'like', '%'.$stat.'%')->orderBy('created_at', 'desc')->get();
                }
            }else{
                $data['form'] = FormPenangananIt::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
            }
        }

        return view('admin.form.it.index', $data);
    }

    public function form($id = null){
        $data['menu'] = '8';
        $data['kode'] = $this->generateKode();
        $data['cabang'] = Cabang::orderBy('inisial', 'asc')->get();
        $data['karyawan'] = KaryawanAll::where('dep', 'IT')->where('ket', '1')->get();
        if(is_null($id)){
            
        }

        return view('admin.form.it.form', $data);
    }

    public function view($id){
        $data['menu'] = '8';
        $data['formPenangananIt'] = FormPenangananIt::find($id);

        return view('admin.form.it.view', $data);
    }

    public function store(Request $req){
        $this->val($req);

        $user = User::where('dep', $req->cabang)->first();

        FormPenangananIt::create([
            'kode' => $req->kode,
            'tgl' => date('Y-m-d'),
            'masalah' => $req->masalah,
            'penyelesaian' => '-',
            'stat' => 1,
            'user_id' => $user->id
        ]);
        
        $form = FormPenangananIt::orderBy('id', 'desc')->first();
        helper::notifikasiFormIt($req->cabang);

        return redirect()->route('penanganan.it')->with('success', 'Form berhasil diajukan.');
    }

    public function verifikasi(VerifikasiRequest $request){
        $form = FormPenangananIt::find($request->id);
        $karyawan = KaryawanAll::where('nik', $request->nik)->where('dep', 'IT')->first();
        // dd($karyawan);

        if(empty($karyawan)){
            return redirect()->route('penanganan.it')->with('danger', 'Verifikasi tidak valid.');
        }

        if($request->tindakan == 1){
            $form->stat = 2;
            $form->save();
            DetailFormPenangananIt::create([
                'keterangan' => 'Sudah diacc dan sedang dilakukan proses pengerjaan.',
                'karyawanId' => $karyawan->id,
                'formPenangananItId' => $form->id
            ]);
        }else{
            $form->stat = 4;
            $form->save();
            DetailFormPenangananIt::create([
                'keterangan' => $request->keterangan,
                'karyawanId' => $karyawan->id,
                'formPenangananItId' => $form->id
            ]);
        }

        return redirect()->route('penanganan.it')->with('success', 'Form berhasil diverifikasi.');
    }

    public function status(Request $request){
        $form = FormPenangananIt::find($request->id);
        $karyawan = KaryawanAll::where('nik', $request->nik)->where('dep', 'IT')->first();
        // dd($karyawan);

        if(empty($karyawan)){
            return redirect()->route('penanganan.it')->with('danger', 'Ubah status gagal.');
        }

        $form->stat = $request->status;
        $form->penyelesaian = $request->keterangan;
        $form->save();

        DetailFormPenangananIt::create([
            'keterangan' => $request->keterangan,
            'karyawanId' => $karyawan->id,
            'formPenangananItId' => $form->id
        ]);

        return redirect()->route('penanganan.it')->with('success', 'Status berhasil diubah.');
    }

    public function delete($id){
        $form = FormPenangananIt::find($id);
        $form->delete();

        return redirect()->route('penanganan.it')->with('success', 'Form berhasil dihapus.');
    }

    public function val($req){
        $message = [
            'required' => 'Form ini tidak boleh kosong!'
        ];

        $this->validate($req, [
            'kode' => 'required',
            'cabang' => 'required',
            'masalah' => 'required',
        ], $message);
    }

    public function generateKode(){
        $kode = 'FID';
        $date = date('Y-m');
        $data = FormPenangananIt::where('tgl', 'like', '%'.$date.'%')->orderBy('id', 'desc')->first();

        if(empty($data)){
            $kode .= date('ym').'001';
        }else{
            $row = explode(date('ym'), $data->kode);
            $kode .= date('ym').$row[1]+1;
        }

        return $kode;
    }
}
