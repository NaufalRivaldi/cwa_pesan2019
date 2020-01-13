<?php

namespace App\PKK;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'pkk_penilaian';
    protected $fillable = [
        'karyawanId',
        'userId',
        'periodeId',
        'status',
        'kategori'
    ];

    public function karyawan(){
        return $this->belongsTo('App\KaryawanAll', 'karyawanId');
    }

    public function periode(){
        return $this->belongsTo('App\PKK\Periode', 'periodeId');
    }

    public function user(){
        return $this->belongsTo('App\User', 'userId');
    }

    public function detailPenilaian(){
        return $this->hasMany('App\PKK\DetailPenilaian', 'penilaianId');
    }
    
}
