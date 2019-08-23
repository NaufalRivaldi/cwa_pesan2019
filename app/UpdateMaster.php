<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpdateMaster extends Model
{
    protected $table = 'file_master';
    protected $fillable = [
        'file_name', 'tgl'
    ];
}
