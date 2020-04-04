<?php

namespace App\PKK;

use Illuminate\Database\Eloquent\Model;

class DetailPenilaianEmployee extends Model
{
    protected $table = 'pkk_detail_penilaian_empolyee';
    protected $fillable = [
        'nilai', 'indikatorId', 'penilaianEmployeeId'
    ];

    public $timestamps = false;

    public function indikator(){
        return $this->belongsTo('App\PKK\Indikator', 'indikatorId');
    }

    public function penilaianEmployee(){
        return $this->belongsTo('App\PKK\PenilaianEmployee', 'penilaianEmployeeId');
    }
}
