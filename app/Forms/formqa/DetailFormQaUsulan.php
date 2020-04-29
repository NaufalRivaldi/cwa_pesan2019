<?php

namespace App\Forms\formqa;

use Illuminate\Database\Eloquent\Model;

class DetailFormQaUsulan extends Model
{
    protected $table = 'detail_form_qa_usulan';
    protected $fillable = [
        'qty', 'formId', 'fileId'
    ];

    public $timestamps = false;

    public function form()
    {
        return $this->belongsTo('App\Forms\formqa\FormQaUsulan', 'formId');
    }

    public function file()
    {
        return $this->belongsTo('App\Forms\formqa\MasterFile', 'fileId');
    }

}
