<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sarana extends Model
{
    protected $table = 'sarana';
    protected $fillable = ['namaSarana'];
    public $timestampt = false;

    // fk
    public function detailForm(){
        return $this->hasMany('App\DetailFormPeminjamanSarana', 'saranaId');
    }
}
