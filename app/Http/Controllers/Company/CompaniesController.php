<?php

namespace App\Http\Controllers\Company;

use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCompanyRequest;

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

    public function store(CreateCompanyRequest $request)
    {
        $company = new Company($request->validated());

        auth()->user()->company()->save($company);

        return redirect()->route('companies.index')
            ->with('info', 'Empresa registrada correctamente');
    }
}
