<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;

class ShowBankController extends Controller
{
    public function __invoke(Bank $bank)
    {
        return view('banks.show', compact('bank'));
    }
}
