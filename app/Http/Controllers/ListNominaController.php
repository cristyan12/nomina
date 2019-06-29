<?php

namespace App\Http\Controllers;

use App\Nomina;
use Illuminate\Http\Request;

class ListNominaController extends Controller
{
	public function __invoke()
	{
		return view('nomina.index', [
            'nominas' => Nomina::paginate(),
        ]);
	}
}
