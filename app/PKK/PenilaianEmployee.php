<?php

namespace App\PKK;

use Illuminate\Database\Eloquent\Model;

class PenilaianEmployee extends Model
{
    protected $table = 'pkk_penilaian_employee';
    protected $fillable = [
        't', 'ip', 'ik', 'p', 'total', 'karyawanId', 'periodeId', 'userId'
    ];

    // fk
    public function karyawan(){
        return $this->belongsTo('App\KaryawanAll', 'karyawanId');
    }

    public function periode(){
        return $this->belongsTo('App\PKK\Periode', 'periodeId');
    }

    public function detailPenilaianEmployee(){
        return $this->hasMany('App\PKK\DetailPenilaianEmployee', 'penilaianEmployeeId');
    }

    public function user(){
        return $this->belongsTo('App\User', 'userId');
    }
}
