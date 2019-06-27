<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListNominaController extends Controller
{
	public function __invoke()
	{
		return view('nomina.index');
	}
}
