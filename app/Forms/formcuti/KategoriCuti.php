<?php

namespace App\Forms\formcuti;

use Illuminate\Database\Eloquent\Model;

class KategoriCuti extends Model
{
    protected $table = 'kategori_cuti';
    protected $fillable = [
        'kategori',
        'jumlahCuti'
    ];

    public $timestamps = false;

    public function cuti(){
        return $this->hasMany('App\Forms\formcuti\FormCuti','idKategori');
    }
}
