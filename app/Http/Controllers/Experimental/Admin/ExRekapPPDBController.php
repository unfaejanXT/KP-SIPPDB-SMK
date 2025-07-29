<?php

namespace App\Http\Controllers\Experimental\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExRekapPPDBController extends Controller
{
    public function index(){
        return view("experimental.admin.rekap.index");
    }

    
}
