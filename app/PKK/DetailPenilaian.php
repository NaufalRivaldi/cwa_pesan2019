<?php

namespace App\PKK;

use Illuminate\Database\Eloquent\Model;

class DetailPenilaian extends Model
{
    protected $table = 'pkk_detailpenilaian';
    protected $fillable = [
        'penilaianId',
        'karyawanId'
    ];
    public $timestamps = false;

    public function penilaian(){
        return $this->belongsTo('App\PKK\Penilaian', 'penilaianId');
    }

    public function karyawan(){
        return $this->belongsTo('App\Karyawan', 'karyawanId');
    }

    public function detailKuisioner()
    {
        return $this->hasMany('App\PKK\DetailKuisioner', 'detailPenilaianId');
    }

    public function detailIndikator()
    {
        return $this->hasMany('App\PKK\DetailIndikator', 'detailPenilaianId');
    }
}
