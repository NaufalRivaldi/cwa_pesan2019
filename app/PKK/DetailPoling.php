<?php

namespace App\PKK;

use Illuminate\Database\Eloquent\Model;

class DetailPoling extends Model
{
    protected $table = 'pkk_detailpoling';
    protected $fillable = [
        'polingId',
        'karyawanId'
    ];
    public $timestamps = false;

    public function poling(){
        return $this->belongsTo('App\PKK\Poling', 'polingId');
    }

    public function karyawan(){
        return $this->belongsTo('App\KaryawanAll', 'karyawanId');
    }

}


