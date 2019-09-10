<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class helper{
    // get divisi name
    public static function get_divisi($inisial){
        $cab = DB::table('cabang')->where('inisial', $inisial)->first();
        return (isset($cab->nama_cabang) ? $cab->nama_cabang : '');
    }

    // get value of loadingbar
    public static function get_val($score){
        $score = $score / 1000;
        return (int)$score;
    }
}