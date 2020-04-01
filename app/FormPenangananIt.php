<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormPenangananIt extends Model
{
    protected $table = 'form_penanganan_it';
    protected $fillable = [
        'kode', 'tgl', 'masalah', 'penyelesaian', 'stat', 'user_id', 'karyawan_all_id'
    ];

    // fk
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function karyawanAll(){
        return $this->belongsTo('App\KaryawanAll');
    }
}
