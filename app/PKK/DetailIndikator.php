<?php

namespace App\PKK;

use Illuminate\Database\Eloquent\Model;

class DetailIndikator extends Model
{
    protected $table = 'pkk_detailindikator';
    protected $fillable = [
        'detailPenilaianId',
        'indikatorId',
        'nilai'
    ];
    public $timestamps = false;

    public function detailPenilaian()
    {
        return $this->belongsTo('App\PKK\DetailPenilaian', 'detailPenilaianId');
    }

    public function indikator()
    {
        return $this->belongsTo('App\PKK\Indikator', 'indikatorId');
    }
}
