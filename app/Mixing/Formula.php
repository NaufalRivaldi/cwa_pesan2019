<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    protected $table = 'formula';
    protected $fillable = [
        'color', 'merkId'
    ];

    public $timestamps = false;

    // fk
    public function merk(){
        return $this->belongsTo('App\Merk', 'merkId');
    }

    public function detailFormula(){
        return $this->hasMany('App\DetailFormula', 'formulaId');
    }
}
