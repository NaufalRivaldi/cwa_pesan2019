<?php

namespace App\Mixing;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    protected $table = 'base';
    protected $fillable = [
        'nama', 'productId'
    ];

    public $timestamps = true;
}
