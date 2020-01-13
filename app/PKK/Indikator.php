<?php

namespace App\PKK;

use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    protected $table = 'pkk_indikator';
    protected $fillable = [
        'pertanyaan',
        'status',
        'kategori'
    ];
    public $timestamps =  false;

    
    public function detailIndikator()
    {
        return $this->hasMany('App\PKK\DetailIndikator', 'indikatorId');
    }
}
