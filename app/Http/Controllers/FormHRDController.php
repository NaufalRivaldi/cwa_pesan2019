<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\helper; 
use Carbon\Carbon;

use App\FormHRD;
use App\KategoriHRD;
use App\SetKategoriHRD;
use App\KaryawanAll;
use App\ValidasiFhrd;
use App\Cabang;

class FormHRDController extends Controller
{
    public function index(){
        $menu = 8;
        $no = 1;
        $form = FormHRD::whereHas('user', function($query){
            $query->whereDep(auth()->user()->dep);
        })->orderBy('created_at', 'desc')->get();

        return view('admin.form.hrd.index', compact('menu', 'no', 'form'));
    }

    public function form(){
        $menu = 8;
        $kategori = KategoriHRD::all();

        if(auth()->user()->level > 2 && auth()->user()->level != 7){
            $karyawan = KaryawanAll::where('dep', auth()->user()->dep)->where('stat', auth()->user()->level)->get();
        }else if(auth()->user()->level <= 2 || auth()->user()->level == 7){
            $karyawan = KaryawanAll::where('dep', auth()->user()->dep)->get();
        }

        return view('admin.form.hrd.form', compact('menu', 'karyawan', 'kategori'));
    }

    public function detail($id){
        $menu = 8;
        $form = FormHRD::find($id);
        $data['set_modal'] = helper::setTitle($form->karyawanAll->stat, $form->karyawanAll->dep);

        return view('admin.form.hrd.detail', compact('menu', 'form', 'data'));
    }

    public function detailVer($id){
        $menu = 9;
        $form = FormHRD::find($id);
        if(auth()->user()->dep = 'HRD'){

            $data['set_modal'] = array('title' => 'HRD', 'stat' => '7');
        }else{
            $data['set_modal'] = helper::setTitle($form->karyawanAll->stat, $form->karyawanAll->dep);
        }

        return view('admin.formhrd.verivikasi.detail', compact('menu', 'form', 'data'));
    }

    public function verivikasi(){
        $menu = 9;
        $no = 1;
        
        // hrd
        if(auth()->user()->level == 7){
            $form = FormHRD::where('stat', 2)->orderBy('created_at', 'desc')->get();
        }else{
            $form = FormHRD::whereHas('KaryawanAll', function($query){
                $query->whereIn('dep', helper::setViewVerivikasi());
            })->orderBy('created_at', 'desc')->get();
        }

        return view('admin.formhrd.verivikasi.index', compact('menu', 'no', 'form'));
    }

    public function laporan(){
        $menu = 9;
        $no = 1;
        $month = date('Y-m-01 H:i:s');
        $kategori = KategoriHRD::all();
        $cabang = Cabang::orderBy('inisial', 'asc')->get();

        if(empty($_GET)){
           $form = FormHRD::join('karyawan_all', 'form_hrd.karyawan_all_id', '=', 'karyawan_all.id')->orderBy('form_hrd.created_at', 'asc')->orderBy('karyawan_all.dep', 'asc')->select('form_hrd.id',  'form_hrd.tgl_a', 'form_hrd.tgl_b', 'karyawan_all_id', 'keterangan', 'lembur', 'form_hrd.stat')->where('form_hrd.stat', 3)->whereHas('KaryawanAll', function($query){
            $query->whereIn('dep', helper::setOffice());
            })->where('tgl_a', '>=', $month)->get();
        }else{
            $tgl_a = '';
            $tgl_b = '';
            $kategoriSet = [];
            $dep = [];
            $urls = explode('&', $_SERVER['QUERY_STRING']);
            foreach($urls as $url){
                $value = explode('=', $url);
                if($value[0] == 'tgl_a')
                    $tgl_a = $value[1];
                
                if($value[0] == 'tgl_b')
                    $tgl_b = $value[1];

                if($value[0] == 'kategori')
                    $kategoriSet[] = $value[1];

                if($value[0] == 'dep')
                    $dep[] = $value[1];
            }
            
            $form = FormHRD::join('karyawan_all', 'form_hrd.karyawan_all_id', '=', 'karyawan_all.id')->orderBy('form_hrd.created_at', 'asc')->orderBy('karyawan_all.dep', 'asc')->select('form_hrd.id', 'form_hrd.tgl_a', 'form_hrd.tgl_b', 'karyawan_all_id', 'keterangan', 'lembur', 'form_hrd.stat')->where('form_hrd.stat', 3)->whereBetween('tgl_a', [$tgl_a, $tgl_b])->get();
        }

        return view('admin.formhrd.laporan.index', compact('menu', 'no', 'divisi', 'form', 'kategori', 'cabang'));
    }

    public function store(Request $req){
        $this->val($req);
        $lembur = 2;

        if(!empty($req->lembur) && $req->lembur == 1){
            $lembur = 1;
        }

        FormHRD::create([
            'tgl_a' => $req->tgl_a.' '.$req->time_a,
            'tgl_b' => $req->tgl_b.' '.$req->time_b,
            'keterangan' => $req->keterangan,
            'lembur' => $lembur,
            'stat' => '1',
            'user_id' => auth()->user()->id,
            'karyawan_all_id' => $req->karyawanall_id
        ]);

        // set kategori
        $form = FormHRD::orderBy('id', 'desc')->first();
        $this->setKategori($req->kategori, $form->id);

        return redirect('/admin/formhrd')->with('status', 'formhrd-success');
    }

    public function acc(Request $req, $form_id){
        $this->valAcc($req);
        $nik = $req->nik;
        $password = sha1($req->password);
        $karyawan_stat = $req->karyawanStat;

        // cari data sesuai dengan jabatannya
        if($karyawan_stat == 2){
            $karyawan = KaryawanAll::where('nik', $nik)->where('password', $password)->where('dep', auth()->user()->dep)->where('stat', $karyawan_stat)->first();
        }else if($karyawan_stat > 2){
            $karyawan = KaryawanAll::where('nik', $nik)->where('password', $password)->where('stat', $karyawan_stat)->first();
        }
        
        if(isset($karyawan)){
            $stat = 2;
            $form = FormHRD::find($form_id);
            $form->stat = $stat;
            $form->save();

            // save validasi hrd
            $this->validasiFormAcc($req, $form_id, $karyawan->id, $stat);

            return redirect()->back()->with('status', 'form-success');
        }

        return redirect()->back()->with('status', 'form-error');
    }

    public function accHRD(Request $req, $form_id){
        $this->valAcc($req);
        $nik = $req->nik;
        $password = sha1($req->password);
        $karyawan_stat = $req->karyawanStat;

        // cari data sesuai dengan jabatannya
        $karyawan = KaryawanAll::where('nik', $nik)->where('password', $password)->where('dep', 'HRD')->first();
        
        if(isset($karyawan)){
            $stat = 3;
            $form = FormHRD::find($form_id);
            $form->stat = $stat;
            $form->save();

            // save validasi hrd
            $this->validasiFormAcc($req, $form_id, $karyawan->id, $stat);

            return redirect()->back()->with('status', 'form-success');
        }

        return redirect()->back()->with('status', 'form-error');
    }

    public function tolak(Request $req, $form_id){
        $this->valTolak($req);
        $nik = $req->nik;
        $password = sha1($req->password);
        $karyawan_stat = $req->karyawanStat;

        // cari data sesuai dengan jabatannya
        if($karyawan_stat == 2){
            $karyawan = KaryawanAll::where('nik', $nik)->where('password', $password)->where('dep', auth()->user()->dep)->where('stat', $karyawan_stat)->first();
        }else if($karyawan_stat > 2){
            $karyawan = KaryawanAll::where('nik', $nik)->where('password', $password)->where('stat', $karyawan_stat)->first();
        }
        
        if(isset($karyawan)){
            $stat = 4;
            $form = FormHRD::find($form_id);
            $form->stat = $stat;
            $form->save();

            // save validasi hrd
            $this->validasiFormAcc($req, $form_id, $karyawan->id, $stat);

            return redirect()->back();
        }

        return redirect()->back()->with('status', 'form-error');
    }

    public function tolakHRD(Request $req, $form_id){
        $this->valTolak($req);
        $nik = $req->nik;
        $password = sha1($req->password);
        $karyawan_stat = $req->karyawanStat;

        // cari data sesuai dengan jabatannya
        $karyawan = KaryawanAll::where('nik', $nik)->where('password', $password)->where('dep', 'HRD')->first();
        
        if(isset($karyawan)){
            $stat = 4;
            $form = FormHRD::find($form_id);
            $form->stat = $stat;
            $form->save();

            // save validasi hrd
            $this->validasiFormAcc($req, $form_id, $karyawan->id, $stat);

            return redirect()->back();
        }

        return redirect()->back()->with('status', 'form-error');
    }

    // function tambahan
    public function setKategori($kategori, $no_form){
        for($i = 0; $i < count($kategori); $i++){
            SetKategoriHRD::create([
                'kategori_fhrd_id' => $kategori[$i],
                'form_hrd_id' => $no_form
            ]);
        }
    }

    private function val($req){
        $message = [
            'required' => ':attribute tidak boleh kosong!'
        ];

        $this->validate($req, [
            'kategori' => 'required',
            'karyawanall_id' => 'required',
            'tgl_a' => 'required',
            'time_a' => 'required',
            'keterangan' => 'required'
        ], $message);
    }

    private function valAcc($req){
        $message = [
            'required' => ':attribute tidak boleh kosong!',
            'min' => ':attribute tidak valid'
        ];

        $this->validate($req, [
            'nik' => 'required|min:8',
            'password' => 'required'
        ], $message);
    }

    private function valTolak($req){
        $message = [
            'required' => ':attribute tidak boleh kosong!',
            'min' => ':attribute tidak valid'
        ];

        $this->validate($req, [
            'nik' => 'required|min:8',
            'password' => 'required',
            'keterangan' => 'required'
        ], $message);
    }

    public function validasiFormAcc($req, $form_id, $karyawan_id, $stat){
        $keterangan = '-';
        if(!empty($req->keterangan)){
            $keterangan = $req->keterangan;
        }
        ValidasiFhrd::create([
            "form_hrd_id" => $form_id,
            "user_id" => auth()->user()->id,
            "karyawan_all_id" => $karyawan_id,
            "stat" => $stat,
            "keterangan" => $keterangan
        ]);
    }
}
