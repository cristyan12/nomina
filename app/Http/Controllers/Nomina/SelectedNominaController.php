<?php

namespace App\Http\Controllers\Nomina;

use App\Nomina;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelectedNominaController extends Controller
{
    public function index()
    {
        return view('nomina.select', [
            'nominas' => Nomina::orderBy('id')->paginate()
        ]);
    }

    public function show()
    {
        return view('nomina.selected');
    }
}
