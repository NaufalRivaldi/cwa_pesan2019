<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KaryawanAll extends Model
{
    protected $table = 'karyawan_all';
    protected $fillable = [
        'id', 'nik', 'nama', 'dep', 'password', 'stat'
    ];

    // fk
    public function hrd(){
        return $this->hasMany('App\FormHRD');
    }

    public function formPenangananIt(){
        return $this->hasMany('App\FormPenangananIt');
    }
}
