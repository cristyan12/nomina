<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class UpdateCompanyController extends Controller
{
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $company->update($request->all());
        
        return redirect()->route('companies.show', $company)
            ->with('info', 'Empresa actualizada con éxito');
    }
}
