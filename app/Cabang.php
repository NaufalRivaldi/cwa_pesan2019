<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'cabang';
    protected $fillable = [
        'inisial', 'nama_cabang'
    ];
    public $timestamps = false;
}
