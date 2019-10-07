<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'pesan';
    protected $fillable = [
        'subject', 'massage', 'tgl', 'stat', 'user_id'
    ];
}
