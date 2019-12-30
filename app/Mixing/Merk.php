<?php

namespace App\Mixing;

use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    protected $table = 'merk';
    protected $fillable = ['name'];
    public $timestamps = false;

    // fk
    public function product(){
        return $this->hasMany('App\Mixing\Product', 'merkId');
    }

    public function formula(){
        return $this->hasMany('App\Mixing\Formula', 'merkId');
    }
}
