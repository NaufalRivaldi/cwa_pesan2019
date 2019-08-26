<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $table = 'finance';
    protected $fillable = [
        'tgl', 'nama', 'file_name', 'user_id'
    ];
}
