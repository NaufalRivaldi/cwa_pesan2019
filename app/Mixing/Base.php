<?php

namespace App\Mixing;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    protected $table = 'base';
    protected $fillable = [
        'name', 'productId'
    ];

    public $timestamps = false;

    public function mixing(){
        return $this->hasMany('App\Mixing\Mixing', 'baseId');
    }

    public function product(){
        return $this->belongsTo('App\Mixing\Product', 'productId');
    }
}
