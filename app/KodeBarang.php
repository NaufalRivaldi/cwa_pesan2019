<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeBarang extends Model
{
    protected $table = 'kode_barang';
    protected $fillable = [
        'kdbr', 'nmbr'
    ];
}
