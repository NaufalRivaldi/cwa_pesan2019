<?php

namespace App\Forms\formcuti;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $table = 'cuti';
    protected $fillable = [
        'sisaCuti',
        'periode',
        'idKategori',
        'idKaryawan',
        'status'
    ];
    
    public function karyawan(){
        return $this->belongsTo('App\KaryawanAll', 'idKaryawan');
    }

    public function kategoriCuti(){
        return $this->belongsTo('App\Forms\formcuti\KategoriCuti', 'idKategori');
    }

    public function detailCuti()
    {
        return $this->hasMany('App\Forms\formcuti\DetailFormCuti', 'idCuti');
    }
}
