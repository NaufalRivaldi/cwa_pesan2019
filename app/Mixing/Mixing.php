<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mixing extends Model
{
    protected $table = 'mixing';
    protected $fillable = [
        'createDate', 'qty', 'unit', 'colorCode', 'base', 'userId', 'customersId', 'productId','colorName'
    ];

    // fk
    public function users(){
        return $this->belongsTo('App\Users', 'userId');
    }

    public function customers(){
        return $this->belongsTo('App\Customers', 'customersId');
    }
    
    public function product(){
        return $this->belongsTo('App\Product', 'productId');
    }

    public function detailFormula(){
        return $this->hasMany('App\detailFormula', 'mixingId');
    }
}
