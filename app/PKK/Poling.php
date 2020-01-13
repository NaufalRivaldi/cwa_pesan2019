<?php

namespace App\PKK;

use Illuminate\Database\Eloquent\Model;

class Poling extends Model
{    
    protected $table = 'pkk_poling';
    protected $fillable = [
        'karyawanId',
        'userId',
        'periodeId',
        'status',
        'kategori'
    ];
    
    public function karyawan(){
        return $this->belongsTo('App\KaryawanAll', 'karyawanId');
    }

    public function periode(){
        return $this->belongsTo('App\PKK\Periode', 'periodeId');
    }

    public function user(){
        return $this->belongsTo('App\User', 'userId');
    }

    public function detailPoling(){
        return $this->hasMany('App\PKK\DetailPoling', 'polingId');
    }
}
