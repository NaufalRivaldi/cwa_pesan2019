<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

// model
use App\Karyawan;
use App\KaryawanAll;
use App\KodeBarang;
use App\Kriteria;
use App\Penerima;
use App\SetKategoriHRD;
use App\ValidasiFhrd;
use App\Ultah;
use App\Notifikasi;
use App\User;
use App\FormHRD;
use App\Cabang;
use App\Finance;

use Hash;

class helper{
    // set show menu
    public static function isForm(){
        $dep = auth()->user()->dep;
        $data = array('Office', 'HRD', 'Accounting', 'QA', 'GA', 'IT', 'Finance', 'Pajak', 'SCM');
        if(in_array($dep, $data)){
            return true;
        }else{
            return false;
        }
    }

    public static function isPengumuman(){
        $dep = auth()->user()->dep;
        $data = array('Office', 'HRD', 'Accounting', 'QA', 'GA', 'IT', 'Finance', 'Pajak', 'SCM', 'Gudang', 'MT');
        if(in_array($dep, $data)){
            return true;
        }else{
            return false;
        }
    }

    public static function isPenjualanPU(){
        $dep = auth()->user()->dep;
        $data = array('IT', 'SCM');
        if(in_array($dep, $data)){
            return true;
        }else{
            return false;
        }
    }

    public static function isFinance(){
        $dep = auth()->user()->dep;
        $data = array('Accounting', 'QA', 'GA', 'Pajak', 'Office', 'SCM');
        if(!in_array($dep, $data)){
            return true;
        }else{
            return false;
        }
    }
    public static function ubahFinance(){
        $dep = auth()->user()->dep;
        $data = array('IT', 'Finance');
        if(!in_array($dep, $data)){
            return true;
        }else{
            return false;
        }
    }

    public static function isInsertFinance(){
        $dep = auth()->user()->dep;
        $data = array('Accounting', 'QA', 'GA', 'Pajak', 'Office', 'SCM', 'Gudang');
        if(!in_array($dep, $data)){
            return true;
        }else{
            return false;
        }
    }

    public static function isMaster(){
        $dep = auth()->user()->dep;
        $data = array('Accounting', 'QA', 'GA', 'Finance', 'Pajak', 'Office');
        if(!in_array($dep, $data)){
            return true;
        }else{
            return false;
        }
    }

    public static function isFormHRD(){
        $dep = auth()->user()->dep;
        $data = array('IT', 'Office', 'HRD');
        if(in_array($dep, $data)){
            return true;                                                    
        }else{
            return false;
        }
    }

    public static function isVerifikasi(){
        $dep = auth()->user()->dep;
        $data = array('Office', 'HRD');
        if(in_array($dep, $data)){
            return true;                                                    
        }else{
            return false;
        }
    }

    public static function isHRD(){
        $dep = auth()->user()->dep;
        $data = array('IT', 'HRD');
        if(in_array($dep, $data)){
            return true;                                                    
        }else{
            return false;
        }
    }

    public static function isAM(){
        $dep = auth()->user()->dep;
        $level = auth()->user()->level;
        $data = array('IT', 'Office');
        $stat = array('2', '3');
        if(in_array($dep, $data) && in_array($level, $stat)){
            return true;                                                    
        }else{
            return false;
        }
    }

    // set show menu

    // password default
    public static function passDefault(){
        $user = User::find(auth()->user()->id);
        if(Hash::check('123456', $user->password)){
            return true;
        }else{
            return false;
        }
    }

    // dep
    public static function depOffice(){
        return array('IT', 'QA', 'GA', 'HRD', 'Gudang', 'Finance', 'Accounting', 'SCM', 'Pajak', 'MT');
    }

    // ultah
    public static function getUltah(){
        $now = date('m-d');
        $ultah = Ultah::where('tgl', 'like', '%'.$now.'%')->get();

        return $ultah;
    }
    
    // get divisi name
    public static function get_divisi($inisial){
        $cab = DB::table('cabang')->where('inisial', $inisial)->first();
        return (isset($cab->nama_cabang) ? $cab->nama_cabang : '');
    }

    // get value of loadingbar
    public static function get_val($score, $first){
        $score = ($score / $first) * 100;
        return (int)$score;
    }

    public static function get_valPU($score){
        $score = $score / 20;
        return (int)$score;
    }

    // get color of loadingbar
    public static function get_color($val){
        if($val > 70){
            return "bg-primary";
        }else if($val > 50){
            return "bg-success";
        }else if($val > 30){
            return "bg-warning";
        }else{
            return "bg-danger";
        }
    }

    // get karyawan name
    public static function get_karyawan($kd_sales, $divisi){
        $karyawan = Karyawan::where('stat', '1')->where('kd_sales', $kd_sales)->where('divisi', $divisi)->first();
        
        if(isset($karyawan)){
            return $karyawan->nama;
        }else{
            return $kd_sales;
        }
    }

    // ubah nama barang
    public static function nama_barang($kd_barang){
        $kode_barang = KodeBarang::where('kdbr', $kd_barang)->first();

        return $kode_barang['nmbr'];
    }

    // panggil nama kriteria
    public static function nama_kriteria($mrbr, $kdbr){
        $nama = '';
        
        $kriteria = Kriteria::orWhere('kd_merk', 'like', '%'.$mrbr.'%')->first();
        
        // jika dia ada untuk mrbr
        if(!empty($kriteria)){
            $nama = $kriteria->rule_name;
        }else{
            $kriteria = Kriteria::orWhere('kd_barang', 'like', '%'.$kdbr.'%')->first();
            if(!empty($kriteria)){
                $nama = $kriteria->rule_name;
            }else{
                $nama = $kdbr;
            }
        }

        return $nama;
    }

    // ubah text menjadi descripsi singkat
    public static function setDesc($text){
        $text = strip_tags($text);
        $text = str_replace('&nbsp;', '', $text);

        return substr($text, 0, 50);
    }

    // ubah text menjadi descripsi text biasa
    public static function setText($text){
        $text = strip_tags($text);
        $text = str_replace('&nbsp;', '', $text);

        return $text;
    }

    // check read
    public static function read($pesan_id, $user_id){
        $class = '';
        $cek = Penerima::where('pesan_id', $pesan_id)
                        ->where('user_id', $user_id)
                        ->where('read_user', 'n')
                        ->first();
        if(!empty($cek)){
            $class = 'pesan-baru';
        }

        return $class;
    }

    public static function countRead(){
        $belumbaca = Penerima::where('user_id', auth()->user()->id)->where('read_user', 'n')->count();

        return $belumbaca;
    }

    // ubah format tanggal
    public static function setDate($date){
        $date = date('d F Y', strtotime($date));

        return $date;
    }

    public static function setDateForm($date){
        $date = date('d-m-Y', strtotime($date));

        return $date;
    }

    // ubah format tanggal & jam
    public static function setDateTime($date){
        $date = date('d F Y, H:i:s', strtotime($date));

        return $date;
    }

    // set status user
    public static function statusUser($val){
        if($val == 1){
            $val = '<span class="badge badge-info">Active</span>';
        }else{
            $val = '<span class="badge badge-danger">Nonactive</span>';
        }

        return $val;
    }

    // set status karyawan
    public static function statusKaryawan($val){
        if($val == 1){
            $val = '<span class="badge badge-warning">Staff</span>';
        }
        
        if($val == 2){
            $val = '<span class="badge badge-dark">Kepala Bagian</span>';
        }
        
        if($val == 3){
            $val = '<span class="badge badge-success">Area Manager</span>';
        }

        if($val == 4){
            $val = '<span class="badge badge-success">General Manager</span>';
        }

        if($val == 5){
            $val = '<span class="badge badge-success">Asst Direktur</span>';
        }

        if($val == 6){
            $val = '<span class="badge badge-success">Direktur</span>';
        }

        return $val;
    }

    public static function statusKaryawanLaporan($val){
        if($val == 1){
            $val = 'Staff';
        }
        
        if($val == 2){
            $val = 'Kepala Bagian';
        }
        
        if($val == 3){
            $val = 'Area Manager';
        }

        if($val == 4){
            $val = 'General Manager';
        }

        if($val == 5){
            $val = 'Asst Direktur';
        }

        if($val == 6){
            $val = 'Direktur';
        }

        return $val;
    }

    // set status form_hrd
    public static function setStatus($status){
        switch ($status) {
            case '1':
                $status = '<span class="badge badge-primary">Pending</span>';
                break;

            case '2':
                $status = '<span class="badge badge-info">Menunggu Acc HRD</span>';
                break;

            case '3':
                $status = '<span class="badge badge-success">Sudah Acc</span>';
                break;
            
            default:
                $status = '<span class="badge badge-danger">Ditolak</span>';
                break;
        }

        return $status;
    }

    public static function setAlasan($form_id){
        $text = '';
        $data = ValidasiFhrd::where('form_hrd_id', $form_id)->orderBy('stat', 'desc')->first();
        
        if(!empty($data)){
            $text = $data->user->dep.' : '.$data->keterangan;
        }

        return $text;
    }

    // set kategori
    public static function setKategori($form_id){
        $setKategori = '';
        $kategori = SetKategoriHRD::where('form_hrd_id', $form_id)->get();

        foreach($kategori as $row){
            $setKategori = $setKategori.'<span class="badge badge-primary">'.$row->kategoriFhrd->nama_kategori.'</span><br>';
        }

        return $setKategori;
    }

    public static function setKategoriLaporan($form_id){
        $setKategori = '';
        $kategori = SetKategoriHRD::where('form_hrd_id', $form_id)->get();

        foreach($kategori as $row){
            $setKategori = $setKategori.$row->kategoriFhrd->nama_kategori.'/';
        }

        return substr($setKategori, 0, -1);
    }

    public static function setKategoriView($form_id){
        $setKategori = '';
        $kategori = SetKategoriHRD::where('form_hrd_id', $form_id)->get();

        foreach($kategori as $row){
            $setKategori = $setKategori.'<span class="badge badge-primary">'.$row->kategoriFhrd->nama_kategori.'</span>';
        }

        return $setKategori;
    }

    // set jabatan
    public static function setJabatan($val){
        switch ($val) {
            case '1':
                $val = 'Staff';
                break;
            
            case '2':
                $val = 'Kepala Bagian';
                break;
            
            case '3':
                $val = 'Area Manager';
                break;

            case '4':
                $val = 'General Manager';
                break;

            case '5':
                $val = 'Asst Direktur';
                break;

            case '6':
                $val = 'Direktur';
                break;
            default:
                $val = 'Tidak Ada Jabatan';
                break;
        }

        return $val;
    }

    public static function setTitle($stat, $dep){
        $data['title'] = '';
        $data['stat'] = '';

        // Ubah ini klo ada nambah cabang ya
        $office = array('IT', 'QA', 'GA', 'HRD', 'Gudang', 'Finance', 'Accounting', 'SCM', 'Pajak','CA5','CL1','CS1');
        $am = array('CW3','CW4','CW5','CW6','CW7','CW8','CW9','CA0','CA1','CA2','CA3','CA4','CA6','CA7','CA8','CA9', 'CB0', 'MT');
        $gm = array('CW1','CW2');

        if($stat == 1){
            $data['title'] = 'Kepala Bagian';
            $data['stat'] = '2';
        }

        if($stat == 2){
            if(in_array($dep, $office)){
                $data['title'] = 'Asst Direktur';
                $data['stat'] = '5';
            }

            if(in_array($dep, $am)){
                $data['title'] = 'Area Manager';
                $data['stat'] = '3';
            }

            if(in_array($dep, $gm)){
                $data['title'] = 'General Manager';
                $data['stat'] = '4';
            }
        }

        if($stat > 2){
            $data['title'] = 'Direktur';
            $data['stat'] = '6';
        }

        return $data;
    }

    public static function setViewVerivikasi(){
        $level = auth()->user()->level;

        // Ubah ini klo ada nambah cabang ya
        $office = array('IT', 'QA', 'GA', 'HRD', 'Gudang', 'Finance', 'Accounting', 'SCM', 'Pajak','CA5','CL1','CS1');
        $am = array('CW3','CW4','CW5','CW6','CW7','CW8','CW9','CA0','CA1','CA2','CA3','CA4','CA6','CA7','CA8','CA9','MT');
        $gm = array('CW1','CW2');

        if($level == 3){
            return $am;
        }

        if($level == 4){
            return $gm;
        }

        if($level == 5){
            return $office;
        }

        if($level == 6){
            return "Office";
        }
    }

    public static function setOffice(){
        $office = array('IT', 'QA', 'GA', 'HRD', 'Gudang', 'Finance', 'Accounting', 'SCM', 'Pajak', 'MT', 'Office');

        return $office;
    }

    public static function changeArray($data){
        return $data;
    }

    public static function setDiff($tgl_a, $tgl_b, $lembur){
        $waktu = '-';
        $diff = date_diff(date_create($tgl_a), date_create($tgl_b));
        if($lembur == 1){
            $waktu = $diff->h;
        }

        return $waktu;
    }

    public static function setUpahLembur($tgl_a, $tgl_b, $lembur){
        $upah = '-';
        $diff = date_diff(date_create($tgl_a), date_create($tgl_b));
        if($lembur == 1){
            $jam = $diff->h;
            if($jam < 5){
                $upah = $jam * 10000;
            }else if($jam > 4){
                $upah = (4 * 10000) + ($jam - 4) * 15000;
            }
        }

        return $upah;
    }

    public static function allDep(){
        // Ubah ini klo ada nambah cabang ya
        $dep = array('IT', 'QA', 'GA', 'HRD', 'Gudang', 'Finance', 'Accounting', 'SCM', 'Pajak', 'MT', 'Office', 'MT');

        $cabang = Cabang::all();
        foreach($cabang as $row){
            array_push($dep, $row->inisial);
        }

        return $dep;
    }

    public static function minDay($date){
        $date = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($date)));

        return $date;
    }

    public static function plusDay($date){
        $date = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($date)));

        return $date;
    }


    // notif
    public static function showNotifikasi(){
        $now = date('Y-m-d');
        $setdate = date('Y-m-d', strtotime('-5 day', strtotime($now)));
        $notif = Notifikasi::where('user_id', auth()->user()->id)->where('created_at', '>=', $setdate)->orderBy('created_at', 'desc')->get();
        return $notif;
    }

    public static function countNotif(){
        $notif = Notifikasi::where('user_id', auth()->user()->id)->where('stat', '1')->get();

        return count($notif);
    }

    public static function notifikasiPesan($pesan_id, $penerima){
        $link = 'admin/pesan/inbox/detail/'.$pesan_id;
        $ket = '<b>'.auth()->user()->nama.'</b> telah mengirimkan anda pesan.';
        foreach($penerima as $row){
            $data = [
                "link" => $link,
                "keterangan" => $ket,
                "user_id" => $row['user_id'],
                "stat" => 1
            ];
    
            Notifikasi::create($data);
        }
    }

    // notif form hrd global
    public static function notifikasiFormHRD($form_id, $karyawan_id){
        // Ubah ini klo ada nambah cabang ya
        $office = array('IT', 'QA', 'GA', 'HRD', 'Gudang', 'Finance', 'Accounting', 'SCM', 'Pajak','CA5','CL1','CS1');
        $am = array('CW3','CW4','CW5','CW6','CW7','CW8','CW9','CA0','CA1','CA2','CA3','CA4','CA6','CA7','CA8','CA9','MT');
        $gm = array('CW1','CW2');

        $karyawan = KaryawanAll::find($karyawan_id);
        $data = array();

        $link = 'admin/formhrd/verifikasi/detail/'.$form_id;
        $ket = '<b>'.auth()->user()->nama.'</b> telah mengajukkan form.';

        if($karyawan->stat >= 2){
            // Asst direktur
            if(in_array($karyawan->dep, $office)){
                $user = user::where('level', '5')->get();
                
                foreach($user as $row){
                    $data[] = [
                        'karyawan_id' => $row->id
                    ];
                }
            }

            // AM
            if(in_array($karyawan->dep, $am)){
                $user = user::where('level', '3')->get();
                
                foreach($user as $row){
                    $data[] = [
                        'karyawan_id' => $row->id
                    ];
                }
            }

            // GM
            if(in_array($karyawan->dep, $gm)){
                $user = user::where('level', '4')->get();
                
                foreach($user as $row){
                    $data[] = [
                        'karyawan_id' => $row->id
                    ];
                }
            }

            // direktur
            if($karyawan->dep == 'Office'){
                $user = user::where('level', '7')->get();
                
                foreach($user as $row){
                    $data[] = [
                        'karyawan_id' => $row->id
                    ];
                }
            }

            // save notif
            foreach($data as $row){
                $data = [
                    "link" => $link,
                    "keterangan" => $ket,
                    "user_id" => $row['karyawan_id'],
                    "stat" => 1
                ];
        
                Notifikasi::create($data);
            }
        }
    }

    public static function notifikasiAcc($form_id){
        $form = FormHRD::find($form_id);

        $user = User::where('dep', 'HRD')->get();

        $link = 'admin/formhrd/verifikasi/detail/'.$form_id;
        $ket = 'Anda telah menerima form atas nama <b>'.$form->karyawanAll->nama.'('.$form->karyawanAll->dep.')</b>.';
        
        // save notif
        foreach($user as $row){
            $data = [
                "link" => $link,
                "keterangan" => $ket,
                "user_id" => $row->id,
                "stat" => 1
            ];
    
            Notifikasi::create($data);
        }
    }

    public static function notifikasiAccHRD($form_id){
        $form = FormHRD::find($form_id);

        $link = 'admin/formhrd/detail/'.$form_id;
        $ket = 'Form atas nama <b>'.$form->karyawanAll->nama.'('.$form->karyawanAll->dep.')</b> sudah terverifikasi.';
        
        // save notif
        $data = [
            "link" => $link,
            "keterangan" => $ket,
            "user_id" => $form->user_id,
            "stat" => 1
        ];
    
        Notifikasi::create($data);
    }

    public static function notifikasiFormIt($user_id){
        $link = 'admin/formit/';
        $ket = 'Anda telah menerima Form Penanganan IT.';
        
        // save notif
        $data = [
            "link" => $link,
            "keterangan" => $ket,
            "user_id" => $user_id,
            "stat" => 1
        ];
    
        Notifikasi::create($data);
    }

    public static function notifikasiPengumuman($pengumuman_id, $user_id, $text){
        $link = 'admin/dashboard/detailp/'.$pengumuman_id;
        
        // save notif
        $user = User::whereNotIn('id', [$user_id])->get();
        foreach($user as $row){
            $data = [
                "link" => $link,
                "keterangan" => $text,
                "user_id" => $row->id,
                "stat" => 1
            ];
        
            Notifikasi::create($data);
        }
    }

    // cek cabang
    public static function cekUpdateFinance(){
        $cabang = Cabang::where('inisial', auth()->user()->dep)->first();
        $now = date('Y-m-d');
        if(!empty($cabang)){
            $finance = Finance::where('created_at', 'like', '%'.$now.'%')->where('user_id', auth()->user()->id)->first();
            if(empty($finance)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}

