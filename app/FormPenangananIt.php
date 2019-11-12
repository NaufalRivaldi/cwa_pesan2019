<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormPenangananIt extends Model
{
    protected $table = 'form_penanganan it';
    protected $fillable = [
        'tgl', 'masalah', 'penyelesaian', 'stat', 'user_id', 'karyawan_all_id'
    ];
}
