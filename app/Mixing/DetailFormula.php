<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailFormula extends Model
{
    protected $table = 'detailformula';
    protected $fillable = [
        'nilai', 'formulaId', 'mixingId'
    ];

    public $timestamps = false;

    // fk
    public function formula(){
        return $this->belongsTo('App\Formula', 'formulaId');
    }

    public function mixing(){
        return $this->belongsTo('App\Mixing', 'mixingId');
    }
}
