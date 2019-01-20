<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;

class ListBankController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $banks = Bank::orderBy('id', 'DESC')->paginate(10);

        return view('banks.index', compact('banks'));
    }
}
