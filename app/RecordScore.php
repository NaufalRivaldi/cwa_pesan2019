<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordScore extends Model
{
    protected $table = 'record_score';
    protected $fillable = [
        'tgl', 'kd_sales', 'divisi', 'skor'
    ];
}
