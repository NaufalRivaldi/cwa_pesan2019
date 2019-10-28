<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriHRD extends Model
{
    protected $table = 'kategori_fhrd';
    protected $fillable = [
        'nama_kategori'
    ];

    public $timestamps = false;

    // fk
    public function sethrdKategori(){
        return $this->hasMany('App\SetKategoriHRD');
    }

    public function formHrd(){
        return $this->hasMany('App\FormHRD');
    }
}
