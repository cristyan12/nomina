<?php

namespace App\Http\Controllers\Company;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $company = new Company($request->validate([
            'name' => 'required|unique:companies',
            'rif' => 'required',
            'address' => 'nullable',
            'phone_number' => 'nullable',
            'email' => 'nullable',
            'city' => 'nullable'
        ]));

        $request->user()->company()->save($company);

        return redirect()->route('companies.index')
            ->with('info', 'Empresa registrada correctamente');
    }
}
