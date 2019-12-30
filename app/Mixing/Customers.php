<?php

namespace App\Mixing;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'name', 'phone', 'memberId'
    ];

    // fk
    public function mixing(){
        return $this->hasMany('App\Mixing\Mixing', 'customersId');
    }
}
