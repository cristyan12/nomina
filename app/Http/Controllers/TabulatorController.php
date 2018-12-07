<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TabulatorController extends Controller
{
    public function create()
    {
        return view('tabulator.create');
    }
}
