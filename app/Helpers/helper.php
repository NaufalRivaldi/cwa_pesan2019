<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

// model
use App\Karyawan;
use App\KaryawanAll;
use App\KodeBarang;
use App\Kriteria;
use App\Penerima;

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

    // set status form_hrd
    public static function setStatus($status){
        switch ($status) {
            case '1':
                $status = '<span class="badge badge-primary">Menunggu Acc Kepala Bagian</span>';
                break;

            case '2':
                $status = '<span class="badge badge-info">Menunggu Acc HRD</span>';
                break;

            case '3':
                $status = '<span class="badge badge-success">Acc HRD</span>';
                break;
            
            default:
                $status = '<span class="badge badge-danger">Ditolak</span>';
                break;
        }

        return $status;
    }

    // set kategori
    public static function setKategori($data){
        $setKategori = '';
        $data = explode(',', $data);
        $kategori = array(
            '1' => 'Terlambat',
            '2' => 'Dinas Keluar',
            '3' => 'Izin Tidak Masuk Kerja',
            '4' => 'Tidak Absen',
            '5' => 'Pelanggaran',
            '6' => 'Izin Keluar/Pulang',
            '7' => 'Lembur',
            '8' => 'Dll'
        );

        for($i = 0; $i < count($data); $i++){
            foreach($kategori as $a => $nama){
                if($a == $data[$i]){
                    $setKategori = $setKategori.'<span class="badge badge-info">'.$nama.'</span><br>';
                }
            }
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
                $val = 'Supervisor';
                break;
            
            case '3':
                $val = 'Manager';
                break;
            default:
                # code...
                break;
        }

        return $val;
    }
}