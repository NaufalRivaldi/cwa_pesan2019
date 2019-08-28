<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryJual extends Model
{
    protected $table = 'history_jual';
    protected $fillable = [
        'kd_sales', 'tgl', 'divisi', 'kd_barang', 'jml', 'skor', 'brt'
    ];
}
