<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $table = 'departemen';
    protected $fillable = [
        'nama'
    ];

    public $timestamps = false;

    public function prosedur()
    {
        return $this->hasMany('App\Prosedur', 'departemenId');
    }
}
