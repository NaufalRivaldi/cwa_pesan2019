<?php

namespace App\PKK;

use Illuminate\Database\Eloquent\Model;

class Kanidat extends Model
{
    protected $table = 'pkk_kanidat';
    protected $fillable = [
        'poin', 'karyawanId', 'periodeId', 't', 'ip', 'ik', 'p'
    ];

    public $timestamps = false;

    // fk
    public function karyawan(){
        return $this->belongsTo('App\KaryawanAll', 'karyawanId');
    }

    public function periode(){
        return $this->belongsTo('App\PKK\Periode', 'periodeId');
    }
}
