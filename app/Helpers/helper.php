<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

// model
use App\Karyawan;
use App\KodeBarang;

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
}