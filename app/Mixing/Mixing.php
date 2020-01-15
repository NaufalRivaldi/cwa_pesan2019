<?php

namespace App\Mixing;

use Illuminate\Database\Eloquent\Model;

class Mixing extends Model
{
    protected $table = 'mixing';
    protected $fillable = [
        'tglMixing', 'qty', 'unit', 'colorCode', 'baseId', 'userId', 'customersId', 'productId','colorName'
    ];

    // fk
    public function user(){
        return $this->belongsTo('App\User', 'userId');
    }

    public function customers(){
        return $this->belongsTo('App\Mixing\Customers', 'customersId');
    }
    
    public function product(){
        return $this->belongsTo('App\Mixing\Product', 'productId');
    }

    public function detailFormula(){
        return $this->hasMany('App\Mixing\detailFormula', 'mixingId');
    }

    public function base(){
        return $this->belongsTo('App\Mixing\Base', 'baseId');
    }
}
