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

class helper{
    // get divisi name
    public static function get_divisi($inisial){
        $cab = DB::table('cabang')->where('inisial', $inisial)->first();
        return (isset($cab->nama_cabang) ? $cab->nama_cabang : '');
    }

    // get value of loadingbar
    public static function get_val($score){
        $score = $score / 800;
        return (int)$score;
    }

    public static function get_valPU($score){
        $score = $score / 20;
        return (int)$score;
    }

    public static function get_val2($score){
        $score = $score / 250;
        return (int)$score;
    }

    // get color of loadingbar
    public static function get_color($val){
        if($val > 50){
            return "bg-primary";
        }else if($val > 35){
            return "bg-success";
        }else if($val > 25){
            return "bg-warning";
        }else{
            return "bg-danger";
        }
    }

    // get karyawan name
    public static function get_karyawan($kd_sales){
        $karyawan = Karyawan::where('stat', '1')->where('kd_sales', $kd_sales)->first();

        return $karyawan->nama;
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

    // ubah format tanggal
    public static function setDate($date){
        $date = date('d F Y', strtotime($date));

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
            $val = '<span class="badge badge-info">Staff</span>';
        }
        
        if($val == 2){
            $val = '<span class="badge badge-info">Kepala Bagian</span>';
        }
        
        if($val == 3){
            $val = '<span class="badge badge-info">Area Manager</span>';
        }

        if($val == 4){
            $val = '<span class="badge badge-info">General Manager</span>';
        }

        if($val == 5){
            $val = '<span class="badge badge-info">Asst Direktur</span>';
        }

        if($val == 6){
            $val = '<span class="badge badge-info">Direktur</span>';
        }

        return $val;
    }

    // set status form_hrd
    public static function setStatus($status){
        switch ($status) {
            case '1':
                $status = '<span class="badge badge-info">Menunggu Acc</span>';
                break;

            case '2':
                $status = '<span class="badge badge-success">Sudah Acc</span>';
                break;
            
            default:
                $status = '<span class="badge badge-danger">Ditolak</span>';
                break;
        }

        return $status;
    }

    // set kategori
    public static function setKategori($form_id){
        $setKategori = '';
        $kategori = SetKategoriHRD::where('form_hrd_id', $form_id)->get();

        foreach($kategori as $row){
            $setKategori = $setKategori.'<span class="badge badge-info">'.$row->kategoriFhrd->nama_kategori.'</span><br>';
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

    public static function setUrlAcc($stat, $dep){
        $url = '';
        $office = array('IT', 'QA', 'GA', 'HRD', 'Gudang', 'Finance', 'Accounting', 'SCM', 'Pajak');
        $am = array('CW3','CW4','CW5','CW6','CW7','CW8','CW9','CA0','CA1','CA2','CA3','CA4','CA6','CA7','CA8','CA9','MT');
        $gm = array('CW1','CW2','CA5','CL1','CS1');

        if($stat == 1){
            $url = '<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#accKabagModal">Acc Form</a>';
        }

        if($stat == 2){
            if(in_array($dep, $office)){
                $url = '<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#accADModal">Acc Form</a>';
            }

            if(in_array($dep, $am)){
                $url = '<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#accAMModal">Acc Form</a>';
            }

            if(in_array($dep, $gm)){
                $url = '<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#accGMModal">Acc Form</a>';
            }
        }

        if($stat > 2){
            $url = '<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#accMModal">Acc Form</a>';
        }

        return $url;
    }

    public static function setUrlTolak($stat, $dep){
        $url = '';
        $office = array('IT', 'QA', 'GA', 'HRD', 'Gudang', 'Finance', 'Accounting', 'SCM', 'Pajak');
        $am = array('CW3','CW4','CW5','CW6','CW7','CW8','CW9','CA0','CA1','CA2','CA3','CA4','CA6','CA7','CA8','CA9','MT');
        $gm = array('CW1','CW2','CA5','CL1','CS1');

        if($stat == 1){
            $url = '<a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#tolakKabagModal">Tolak</a>';
        }

        if($stat == 2){
            if(in_array($dep, $office)){
                $url = '<a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#tolakADModal">Tolak</a>';
            }

            if(in_array($dep, $am)){
                $url = '<a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#tolakAMModal">Tolak</a>';
            }

            if(in_array($dep, $gm)){
                $url = '<a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#tolakGMModal">Tolak</a>';
            }
        }

        if($stat > 2){
            $url = '<a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#tolakMModal">Tolak</a>';
        }

        return $url;
    }
}

