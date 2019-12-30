<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    protected $table = 'merk';
    protected $fillable = ['name'];
    public $timestamps = false;

    // fk
    public function product(){
        return $this->hasMany('App\Product', 'merkId');
    }

    public function formula(){
        return $this->hasMany('App\Formula', 'merkId');
    }
}
