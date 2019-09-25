<?php

namespace App\Http\Controllers\Company;

use App\{
    Company,
    Http\Controllers\Controller,
    Http\Requests\UpdateCompanyRequest
};

class UpdateCompanyController extends Controller
{
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->validated());
        
        return redirect()->route('companies.show', $company)
            ->with('info', 'Empresa actualizada con éxito');
    }
}
