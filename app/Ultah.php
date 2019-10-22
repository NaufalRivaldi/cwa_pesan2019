<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ultah extends Model
{
    protected $table = "ultah";
    protected $fillable = [
        'nama', 'tgl', 'divisi'
    ];

    public $timestamps = false;
}
