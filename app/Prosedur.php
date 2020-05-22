<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prosedur extends Model
{
    protected $table = 'prosedur';
    protected $fillable = [
        'nama', 'file', 'departemenId'
    ];
    
    public $timestamps = true;

    public function departemen()
    {
        return $this->belongsTo('App\Departemen', 'departemenId');
    }
}
