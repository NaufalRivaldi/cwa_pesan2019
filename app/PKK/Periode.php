<?php

namespace App\PKK;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = 'pkk_periode';
    protected $fillable = [
        'namaPeriode',
        'tglMulai',
        'tglSelesai',
        'status',
        'kategori'
    ];

    public $timestamps = false;    

    public function poling(){
        return $this->hasOne('App\PKK\Poling', 'periodeId');
    }
    
    public function penilaian(){
        return $this->hasOne('App\PKK\Penilaian', 'periodeId');
    }

    public function kanidat(){
        return $this->hasMany('App\PKK\Kanidat', 'periodeId');
    }

    public function penilaianEmployee(){
        return $this->hasMany('App\PKK\PenilaianEmployee', 'periodeId');
    }
}
