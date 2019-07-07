<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::orderBy('id')->paginate();

        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        $company = new Company;

        return view('companies.create', compact('company'));
    }

    public function store(Request $request)
    {
        Company::create($request->all());

        return redirect()->route('companies.index')
            ->with('info', 'Empresa registrada correctamente');
    }
}
