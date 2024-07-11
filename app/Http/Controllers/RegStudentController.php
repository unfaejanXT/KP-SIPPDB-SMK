<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegStudentController extends Controller
{
    public function index()
    {
        return view('layouts.registrations.app');
    }
}
