<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;

class CreateBankController extends Controller
{
	public function create()
	{
		return view('banks.create');
	}

	public function store(Request $request)
	{
		Bank::create($request()->all());

		return redirect()
			->route('banks.index')
			->with('success', 'Banco agregado exitosamente.');
	}
}
