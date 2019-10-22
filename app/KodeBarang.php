<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeBarang extends Model
{
    protected $table = 'kode_barang';
    protected $fillable = [
        'mrbr', 'glbr', 'kmbr', 'jnbr', 'kdbr', 'nmbr'
    ];

    public $timestamps = false;
}
