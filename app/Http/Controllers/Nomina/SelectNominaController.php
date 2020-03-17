<?php

namespace App\Http\Controllers\Nomina;

use App\Nomina;
use App\Http\Controllers\Controller;

class SelectNominaController extends Controller
{
    public function __invoke()
    {
        return view('nomina.select', ['nominas' => Nomina::paginate()]);
    }
}
