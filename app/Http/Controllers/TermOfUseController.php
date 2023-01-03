<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermOfUseController extends Controller
{
    public function index()
    {
        return view('term');
    }
}
