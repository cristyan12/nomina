<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;

class CreateBankController extends Controller
{
	public function __invoke()
	{
		Bank::create(request()->all());

		return redirect()
			->route('banks.index')
			->with('success', 'Banco agregado exitosamente.');
	}
}
