<?php

namespace App\Http\Controllers\Nomina;

use App\Nomina;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListNominaController extends Controller
{
	public function __invoke()
	{
		return view('nomina.index', [
            'nominas' => Nomina::paginate(),
        ]);
	}
}
