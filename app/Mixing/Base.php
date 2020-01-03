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
}
