<?php

namespace App\PKK;

use Illuminate\Database\Eloquent\Model;

class Kuisioner extends Model
{
    protected $table = 'pkk_kuisioner';
    protected $fillable = [
        'pertanyaan',
        'status',
        'kategori'
    ];
    public $timestamps = false;

    public function detailKuisioner()
    {
        return $this->hasMany('App\PKK\DetailKuisioner', 'kuisionerId');
    }
}
