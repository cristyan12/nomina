<?php

namespace App\Http\Controllers;

use App\{
    Account, Company, Employee, Position
};
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::orderBy('id', 'ASC')->paginate(10);

        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        $companies = Company::orderBy('name', 'ASC')->get();
        $employees = Employee::orderBy('last_name', 'ASC')->get();
        $positions = Position::orderBy('id', 'ASC')->get();

        return view('accounts.create', compact('companies', 'employees', 'positions'));
    }

    public function store(Request $request)
    {
        $account = Account::create($request->all());
        
        return redirect()->route('accounts.index')
            ->with('info', 'Cuenta bancaria creada con éxito');
    }

    public function show(Account $account)
    {
        //
    }

    public function edit(Account $account)
    {
        //
    }

    public function update(Request $request, Account $account)
    {
        //
    }

    public function destroy(Account $account)
    {
        //
    }
}
