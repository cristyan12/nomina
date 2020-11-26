<?php

namespace App\Http\Controllers\Company;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowCompanyController extends Controller
{
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }
}
