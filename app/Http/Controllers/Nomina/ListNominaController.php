<?php

namespace App\Http\Controllers\Nomina;

use App\Models\Nomina;
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
