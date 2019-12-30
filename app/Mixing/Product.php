<?php

namespace App\Mixing;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = ['name', 'merkId'];
    public $timestamps = false;

    // fk
    public function merk(){
        return $this->belongsTo('App\Mixing\Merk', 'merkId');
    }

    public function mixing(){
        return $this->hasMany('App\Mixing\Mixing', 'productId');
    }

}
