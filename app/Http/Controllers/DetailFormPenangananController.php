<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DetailFormPenangananIt;

class DetailFormPenangananController extends Controller
{
    public function delete(Request $request){
        $data = DetailFormPenangananIt::find($request->id);
        $data->delete();
    }
}
