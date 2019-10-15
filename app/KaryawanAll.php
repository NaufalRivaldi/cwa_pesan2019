<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KaryawanAll extends Model
{
    protected $table = 'karyawan_all';
    protected $fillable = [
        'nik', 'nama', 'dep', 'stat'
    ];

    // fk
    public function hrd(){
        return $this->hasMany('App\FormHRD');
    }
}
