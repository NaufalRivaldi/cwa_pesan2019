<?php

namespace App\Forms\formcuti;

use Illuminate\Database\Eloquent\Model;

class FormCuti extends Model
{
    protected $table = 'form_cuti';
    protected $fillable = [
        'cuti',
        'sisaCuti',
        'periode',
        'idKategori',
        'idKaryawanAll'
    ];
    
    public function karyawan(){
        return $this->belongsTo('App\KaryawanAll', 'idKaryawanAll');
    }

    public function kategori_cuti(){
        return $this->belongsTo('App\Forms\formcuti\KategoriCuti', 'idKategori');
    }

    public function detail_cuti()
    {
        return $this->hasMany('App\Forms\formcuti\DetailFormCuti', 'idCuti');
    }

}
