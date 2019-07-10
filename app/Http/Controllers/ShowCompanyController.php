<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class ShowCompanyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Company $company)
    {
        return view('companies.show', compact('company'));
    }
}
