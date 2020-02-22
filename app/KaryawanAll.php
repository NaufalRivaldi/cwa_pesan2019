<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KaryawanAll extends Model
{
    protected $table = 'karyawan_all';
    protected $fillable = [
        'id', 'nik', 'nama', 'dep', 'password', 'stat', 'ket', 'masaKerja'
    ];

    // fk
    public function hrd(){
        return $this->hasMany('App\FormHRD');
    }

    public function formPenangananIt(){
        return $this->hasMany('App\FormPenangananIt');
    }

    public function formPengajuanDesain(){
        return $this->hasMany('App\FormPengajuanDesain', 'karyawan_all_id');
    }

    public function poling(){
        return $this->hasOne('App\PKK\Poling', 'karyawanId');
    }    

    public function penilaian(){
        return $this->hasOne('App\PKK\Penilaian', 'karyawanId');
    }

    public function detailPoling(){
        return $this->hasMany('App\PKK\DetailPoling', 'karyawanId');
    }

    public function cuti(){
        return $this->hasMany('App\Forms\formcuti\FormCuti', 'idKaryawanAll');
    } 

    public function verifikasi_cuti(){
        return $this->hasMany('App\Forms\formcuti\VerifikasiFormCuti', 'karyawanAllId');
    }
}
