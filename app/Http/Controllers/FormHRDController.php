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

use App\Exports\LaporanHRDExport;

class FormHRDController extends Controller
{
    public function index(){
        $menu = 8;
        $no = 1;
        // sudah selesai
        $form = FormHRD::whereHas('user', function($query){
            $query->whereDep(auth()->user()->dep);
        })->where('stat', '>', 2)->orderBy('created_at', 'desc')->get();

        // belum acc
        $form_progress = FormHRD::whereHas('user', function($query){
            $query->whereDep(auth()->user()->dep);
        })->where('stat', '<', 3)->orderBy('created_at', 'desc')->get();

        return view('admin.form.hrd.index', compact('menu', 'no', 'form', 'form_progress'));
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

        // cek jika dia tidak ada formnya
        if(empty($form)){
            return redirect()->route('verifikasi')->with('error', 'Form sudah dihapus oleh user terkait.');
        }

        if(auth()->user()->dep == 'HRD'){
            $data['set_modal'] = array('title' => 'HRD', 'stat' => '7');
        }else{
            $data['set_modal'] = helper::setTitle($form->karyawanAll->stat, $form->karyawanAll->dep);
        }

        return view('admin.formhrd.verivikasi.detail', compact('menu', 'form', 'data'));
    }

    public function verivikasi(){
        $menu = 9;
        $no = 1;
        $form_office = '';
        
        // hrd
        if(auth()->user()->level == 7){
            $form_office = FormHRD::where('stat', 1)->whereHas('KaryawanAll', function($query){
                $query->whereIn('dep', ['Office']);
            })->orderBy('created_at', 'desc')->get();
            $form = FormHRD::where('stat', 2)->orderBy('created_at', 'desc')->get();
        }else{
            $form = FormHRD::whereHas('KaryawanAll', function($query){
                $query->whereIn('dep', helper::setViewVerivikasi());
            })->orderBy('created_at', 'desc')->get();
        }

        return view('admin.formhrd.verivikasi.index', compact('menu', 'no', 'form', 'form_office'));
    }

    public function laporan(){
        $menu = 9;
        $no = 1;
        $month = date('Y-m-01 H:i:s');
        $kategori = KategoriHRD::all();
        $cabang = Cabang::orderBy('inisial', 'asc')->get();

        if(empty($_GET)){
           $form = FormHRD::join('karyawan_all', 'form_hrd.karyawan_all_id', '=', 'karyawan_all.id')->orderBy('form_hrd.created_at', 'asc')->select('form_hrd.id',  'form_hrd.tgl_a', 'form_hrd.tgl_b', 'karyawan_all_id', 'keterangan', 'lembur', 'form_hrd.stat')->where('form_hrd.stat', 3)->whereHas('KaryawanAll', function($query){
            $query->whereIn('dep', helper::AllDep());
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
                    $tgl_a = helper::minDay($value[1]);
                    
                if($value[0] == 'tgl_b')
                    $tgl_b = helper::plusDay($value[1]);
                
                if($value[0] == 'kategori')
                    $kategoriSet[] = $value[1];
                
                if($value[0] == 'dep')
                    $dep[] = $value[1];
            }
            
            if(empty($_GET['kategori'])){
                $form = FormHRD::join('karyawan_all', 'form_hrd.karyawan_all_id', '=', 'karyawan_all.id')->orderBy('form_hrd.created_at', 'asc')->orderBy('karyawan_all.dep', 'asc')->select('form_hrd.id', 'form_hrd.tgl_a', 'form_hrd.tgl_b', 'karyawan_all_id', 'keterangan', 'lembur', 'form_hrd.stat')->where('form_hrd.stat', 3)->whereHas('KaryawanAll', function($query){
                    $urls = explode('&', $_SERVER['QUERY_STRING']);
                    $dep = [];
                    foreach($urls as $url){
                        $value = explode('=', $url);
                        if($value[0] == 'dep')
                            if($value[1] == 'All'){
                                $dep = helper::allDep();
                            }else if($value[1] == 'Office'){
                                    $dep = array('IT', 'QA', 'GA', 'HRD', 'Gudang', 'Finance', 'Accounting', 'SCM', 'Pajak', 'MT', 'Office');
                            }else{
                                $dep[] = $value[1];
                            }
                    }
                    $query->whereIn('dep', $dep);
                })->whereBetween('tgl_a', [$tgl_a, $tgl_b])->get();
            }else{
                $form = FormHRD::join('karyawan_all', 'form_hrd.karyawan_all_id', '=', 'karyawan_all.id')->orderBy('form_hrd.created_at', 'asc')->orderBy('karyawan_all.dep', 'asc')->select('form_hrd.id', 'form_hrd.tgl_a', 'form_hrd.tgl_b', 'karyawan_all_id', 'keterangan', 'lembur', 'form_hrd.stat')->where('form_hrd.stat', 3)->whereHas('KaryawanAll', function($query){
                    $urls = explode('&', $_SERVER['QUERY_STRING']);
                    $dep = [];
                    foreach($urls as $url){
                        $value = explode('=', $url);
                        if($value[0] == 'dep')
                            if($value[1] == 'All'){
                                $dep = helper::allDep();
                            }else if($value[1] == 'Office'){
                                    $dep = array('IT', 'QA', 'GA', 'HRD', 'Gudang', 'Finance', 'Accounting', 'SCM', 'Pajak', 'MT', 'Office');
                            }else{
                                $dep[] = $value[1];
                            }
                    }
                    $query->whereIn('dep', $dep);
                })->whereHas('SetKategoriHRD', function($query){
                    $urls = explode('&', $_SERVER['QUERY_STRING']);
                    $kategori = [];
                    foreach($urls as $url){
                        $value = explode('=', $url);
                        if($value[0] == 'kategori')
                            $kategori[] = $value[1];
                    }
                    $query->whereIn('kategori_fhrd_id', $kategori);
                })->whereBetween('tgl_a', [$tgl_a, $tgl_b])->get();
            }
        }
        return view('admin.formhrd.laporan.index', compact('menu', 'no', 'form', 'kategori', 'cabang', 'month'));
    }

    public function view(Request $req){
        $id = $req->form_id;
        $data = FormHRD::find($id);
        echo "
        <b>Tanggal Pembuatan</b><br>
        ".date('d F Y, H:i', strtotime($data->created_at))."
        <hr>
        <b>Kategori</b><br>
        ".helper::setKategoriView($data->id)."
        <hr>
        <b>Nama</b><br>
        ".$data->karyawanAll->nama."
        <hr>
        <b>Bagian / Jabatan</b><br>
        ".$data->karyawanAll->dep." / ".helper::statusKaryawan($data->karyawanAll->stat)."
        <hr>
        <b>NIK</b><br>
        ".$data->karyawanAll->nik."
        <hr>
        <b>Tanggal dan Waktu</b><br>
        ".date('d F Y, H:i', strtotime($data->tgl_a))." s/d ".date('d F Y, H:i', strtotime($data->tgl_b))."
        <hr>
        <b>Keterangan</b><br>
        ".$data->keterangan."
        <hr>
        ";

        if($data->lembur == 1){
            echo "
            <b>Lembur</b><br>
            Berbayar
            <hr>
            ";
        }
    }

    public function export(){
        $date = date('d-m-Y');
        $dep = 'All';
        if($_GET){
            $dep = $_GET['dep'];
        }
        return (new LaporanHRDExport)->download('laporanHRD-'.$date.$dep.'.xlsx');
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
        
        // set notif
        helper::notifikasiFormHRD($form->id, $req->karyawanall_id);
            
        return redirect('/admin/formhrd')->with('success', 'Form berhasil diajukan.');
    }

    public function delete(Request $req){
        $id = $req->form_hrd_id;
        $nik = $req->nik;
        $password = sha1($req->password);
        $karyawan = KaryawanAll::where('nik', $nik)->where('password', $password)->where('dep', auth()->user()->dep)->where('stat', '>=', '2')->first();
        
        if(isset($karyawan)){
            $form = FormHRD::find($id);
            SetKategoriHRD::where('form_hrd_id', $id)->delete();

            $form->delete();

            return redirect('/admin/formhrd')->with('success', 'Form berhasil dihapus.');
        }else{
            return redirect('/admin/formhrd')->with('error', 'Form gagal dihapus.');
        }

        
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

            // set notif
            helper::notifikasiAcc($form->id);

            return redirect()->back()->with('success', 'Form sudah di acc.');
        }

        return redirect()->back()->with('error', 'Gagal di ACC');
    }

    public function accHRD(Request $req, $form_id){
        $this->valAcc($req);
        $nik = $req->nik;
        $password = sha1($req->password);
        $karyawan_stat = $req->karyawanStat;

        // cari data sesuai dengan jabatannya
        $form = FormHRD::find($form_id);
        
        if($form->karyawanAll->stat > 2){
            $karyawan = KaryawanAll::where('nik', $nik)->where('password', $password)->where('dep', 'HRD')->where('stat', '2')->first();
        }else{
            $karyawan = KaryawanAll::where('nik', $nik)->where('password', $password)->where('dep', 'HRD')->first();
        }
        
        if(isset($karyawan)){
            $stat = 3;

            $form->stat = $stat;
            $form->save();

            // save validasi hrd
            $this->validasiFormAcc($req, $form_id, $karyawan->id, $stat);
            
            // set notif
            helper::notifikasiAccHRD($form->id);

            return redirect()->back()->with('success', 'Form sudah di acc.');
        }

        return redirect()->back()->with('error', 'Gagal di ACC');
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

            // set notif
            helper::notifikasiAccHRD($form->id);

            return redirect()->back()->with('success', 'Form ditolak!');
        }

        return redirect()->back()->with('error', 'Gagal di Tolak');
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

            // set notif
            helper::notifikasiAccHRD($form->id);

            return redirect()->back()->with('success', 'Form ditolak!');
        }

        return redirect()->back()->with('error', 'Gagal di Tolak');
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
