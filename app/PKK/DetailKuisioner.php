<?php

namespace App\PKK;

use Illuminate\Database\Eloquent\Model;

class DetailKuisioner extends Model
{
    protected $table = 'pkk_detailkuisioner';
    protected $fillable = [
        'detailPenilaianId',
        'kuisionerId',
        'jawaban'
    ];

    public $timestamps = false;

    public function detailpenilaian(){
        return $this->belongsTo('App\PKK\DetailPenilaian', 'detailPenilaianId');
    }

    public function kuisioner()
    {
        return $this->belongsTo('App\PKK\Kuisioner', 'kuisionerId');
    }
}
