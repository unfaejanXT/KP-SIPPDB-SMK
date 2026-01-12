<?php

namespace App\Http\Controllers\Sandbox\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExRekapPPDBController extends Controller
{
    public function index(){
        return view("sandbox.admin.rekap.index");
    }

    
}
